<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se existe token na sessão
        $token = session('auth_token');
        $userId = session('user_id');

        if (!$token || !$userId) {
            return redirect()->route('login')->with('error', 'Você precisa fazer login para acessar esta página.');
        }

        // Busca o usuário e verifica se o token é válido
        $user = User::find($userId);

        if (!$user || !$user->isTokenValid() || $user->login_token !== $token) {
            // Remove da sessão se o token for inválido
            session()->forget(['auth_token', 'user_id']);

            return redirect()->route('login')->with('error', 'Sua sessão expirou. Faça login novamente.');
        }

        // Token válido, continua com a requisição
        return $next($request);
    }
}
