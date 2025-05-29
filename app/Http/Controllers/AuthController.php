<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Exibe a página de login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Exibe a página de cadastro
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Processa o login do usuário
     */
    public function login(Request $request)
    {
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'Digite um email válido.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Busca o usuário pelo email
        $user = User::where('email', $request->email)->first();

        // Verifica se o usuário existe e a senha está correta
        if ($user && Hash::check($request->password, $user->password)) {
            // Gera um novo token de login
            $token = $user->generateLoginToken();

            // Armazena o token na sessão
            session(['auth_token' => $token, 'user_id' => $user->id]);

            // Autentica o usuário no Laravel (opcional, para usar Auth::user())
            Auth::login($user);

            return redirect()->route('dashboard')->with('success', 'Login realizado com sucesso!');
        }

        return back()->withErrors(['email' => 'Credenciais inválidas.'])->withInput();
    }

    /**
     * Processa o cadastro do usuário
     */
    public function register(Request $request)
    {
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'Digite um email válido.',
            'email.unique' => 'Este email já está em uso.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
            'password.confirmed' => 'As senhas não coincidem.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Cria o usuário
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Faz login automático após o cadastro
        $token = $user->generateLoginToken();
        session(['auth_token' => $token, 'user_id' => $user->id]);
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Conta criada com sucesso!');
    }

    /**
     * Faz logout do usuário
     */
    public function logout(Request $request)
    {
        // Remove o token do banco de dados
        if (session('user_id')) {
            $user = User::find(session('user_id'));
            if ($user) {
                $user->removeLoginToken();
            }
        }

        // Remove da sessão
        session()->forget(['auth_token', 'user_id']);

        // Logout do Laravel Auth
        Auth::logout();

        // Invalida a sessão
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout realizado com sucesso!');
    }

    /**
     * Exibe o dashboard (página protegida)
     */
    public function dashboard()
    {
        $user = Auth::user();
        return view('dashboard', compact('user'));
    }
}
