<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil - Sistema</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .navbar h1 {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
            position: relative;
        }

        .user-dropdown {
            position: relative;
            display: inline-block;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: background 0.3s ease;
        }

        .user-info:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .dropdown-arrow {
            margin-left: 0.5rem;
            transition: transform 0.3s ease;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            min-width: 200px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .dropdown-menu.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-menu a {
            display: block;
            padding: 0.75rem 1rem;
            color: #333;
            text-decoration: none;
            border-bottom: 1px solid #f0f0f0;
            transition: background 0.3s ease;
        }

        .dropdown-menu a:hover {
            background: #f8f9fa;
        }

        .dropdown-menu a:last-child {
            border-bottom: none;
            color: #dc3545;
        }

        .dropdown-menu a:last-child:hover {
            background: #fee;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
        }

        .breadcrumb {
            margin-bottom: 2rem;
            color: #666;
        }

        .breadcrumb a {
            color: #667eea;
            text-decoration: none;
        }

        .profile-header {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
            text-align: center;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            font-weight: bold;
            color: white;
            margin: 0 auto 1rem;
        }

        .profile-forms {
            display: grid;
            gap: 2rem;
        }

        .form-section {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .form-section h3 {
            color: #333;
            margin-bottom: 1.5rem;
            font-size: 1.3rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #f0f0f0;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
        }

        .btn {
            padding: 0.875rem 1.5rem;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 768px) {
            .navbar-content {
                flex-direction: column;
                gap: 1rem;
            }

            .container {
                padding: 1rem;
            }

            .profile-forms {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-content">
            <h1>Sistema Dashboard</h1>
            <div class="navbar-right">
                <div class="user-dropdown">
                    <div class="user-info" onclick="toggleDropdown()">
                        <div class="user-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <span>{{ $user->name }}</span>
                        <span class="dropdown-arrow">▼</span>
                    </div>
                    <div class="dropdown-menu" id="dropdownMenu">
                        <a href="{{ route('dashboard') }}">📊 Dashboard</a>
                        <a href="{{ route('profile') }}">👤 Meu Perfil</a>
                        <a href="{{ route('settings') }}">⚙️ Configurações</a>
                        <a href="{{ route('logout') }}">🚪 Sair</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a> / Meu Perfil
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="profile-header">
            <div class="profile-avatar">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <h2>{{ $user->name }}</h2>
            <p>{{ $user->email }}</p>
            <p style="color: #666; margin-top: 0.5rem;">
                Membro desde {{ $user->created_at->format('d/m/Y') }}
            </p>
        </div>

        <div class="profile-forms">
            <!-- Atualizar Dados Pessoais -->
            <div class="form-section">
                <h3>Dados Pessoais</h3>
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Nome Completo</label>
                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control"
                               value="{{ old('name', $user->name) }}"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email"
                               id="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email', $user->email) }}"
                               required>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Atualizar Dados
                    </button>
                </form>
            </div>

            <!-- Alterar Senha -->
            <div class="form-section">
                <h3>Alterar Senha</h3>
                <form method="POST" action="{{ route('profile.update-password') }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="current_password">Senha Atual</label>
                        <input type="password"
                               id="current_password"
                               name="current_password"
                               class="form-control"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="new_password">Nova Senha</label>
                        <input type="password"
                               id="new_password"
                               name="new_password"
                               class="form-control"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="new_password_confirmation">Confirmar Nova Senha</label>
                        <input type="password"
                               id="new_password_confirmation"
                               name="new_password_confirmation"
                               class="form-control"
                               required>
                    </div>

                    <button type="submit" class="btn btn-secondary">
                        Alterar Senha
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdownMenu');
            const arrow = document.querySelector('.dropdown-arrow');

            dropdown.classList.toggle('active');
            arrow.style.transform = dropdown.classList.contains('active') ? 'rotate(180deg)' : 'rotate(0deg)';
        }

        // Fecha o dropdown se clicar fora
        document.addEventListener('click', function(event) {
            const dropdown = document.querySelector('.user-dropdown');
            const menu = document.getElementById('dropdownMenu');

            if (!dropdown.contains(event.target)) {
                menu.classList.remove('active');
                document.querySelector('.dropdown-arrow').style.transform = 'rotate(0deg)';
            }
        });
    </script>
</body>
</html>
