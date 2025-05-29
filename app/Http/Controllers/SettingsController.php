<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SettingsController extends Controller
{
    /**
     * Exibe a página de configurações
     */
    public function index()
    {
        $user = Auth::user();

        // Dados para estatísticas
        $accountAge = $user->created_at->diffInDays(Carbon::now());
        $lastLogin = $user->updated_at;
        $tokenExpiry = $user->token_expires_at;

        return view('settings.index', compact('user', 'accountAge', 'lastLogin', 'tokenExpiry'));
    }

    /**
     * Atualiza preferências de notificação
     */
    public function updateNotifications(Request $request)
    {
        // Aqui você pode adicionar campos na migration para preferências
        // Por enquanto, apenas simula a funcionalidade

        return back()->with('success', 'Preferências de notificação atualizadas!');
    }

    /**
     * Revoga todos os tokens ativos (logout de todos os dispositivos)
     */
    public function revokeAllTokens()
    {
        $user = Auth::user();

        // Remove o token atual
        $user->removeLoginToken();

        // Remove da sessão
        session()->forget(['auth_token', 'user_id']);
        Auth::logout();

        return redirect()->route('login')->with('success', 'Todos os acessos foram revogados. Faça login novamente.');
    }

    /**
     * Estende a validade do token atual
     */
    public function extendSession()
    {
        $user = Auth::user();

        if ($user->isTokenValid()) {
            // Estende por mais 24 horas
            $user->token_expires_at = Carbon::now()->addHours(24);
            $user->save();

            return back()->with('success', 'Sessão estendida por mais 24 horas!');
        }

        return back()->with('error', 'Token inválido. Faça login novamente.');
    }

    /**
     * Exporta dados do usuário (LGPD compliance)
     */
    public function exportData()
    {
        $user = Auth::user();

        $userData = [
            'nome' => $user->name,
            'email' => $user->email,
            'data_criacao' => $user->created_at->format('d/m/Y H:i:s'),
            'ultimo_acesso' => $user->updated_at->format('d/m/Y H:i:s'),
            'token_expira_em' => $user->token_expires_at ? $user->token_expires_at->format('d/m/Y H:i:s') : 'N/A',
        ];

        $json = json_encode($userData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        return response($json)
            ->header('Content-Type', 'application/json')
            ->header('Content-Disposition', 'attachment; filename="meus_dados_' . date('Y-m-d') . '.json"');
    }
}
