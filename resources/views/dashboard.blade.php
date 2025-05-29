<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema</title>
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .welcome-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
            text-align: center;
        }

        .welcome-card h2 {
            color: #333;
            margin-bottom: 0.5rem;
            font-size: 2rem;
        }

        .welcome-card p {
            color: #666;
            font-size: 1.1rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border-left: 4px solid #667eea;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .stat-card h3 {
            color: #333;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 0.5rem;
        }

        .stat-card p {
            color: #666;
            font-size: 0.9rem;
        }

        .content-section {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .content-section h3 {
            color: #333;
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }

        .content-section p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 1rem;
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

        .token-info {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            margin: 1rem 0;
            border: 1px solid #e9ecef;
        }

        .token-info code {
            background: #e9ecef;
            padding: 0.2rem 0.4rem;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            font-size: 0.85rem;
        }

        @media (max-width: 768px) {
            .navbar-content {
                flex-direction: column;
                gap: 1rem;
            }

            .navbar-right {
                width: 100%;
                justify-content: space-between;
            }

            .container {
                padding: 1rem;
            }

            .stats-grid {
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
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="welcome-card">
            <h2>Bem-vindo, {{ $user->name }}!</h2>
            <p>Você está logado com sucesso no sistema</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Status da Sessão</h3>
                <div class="stat-value">✓</div>
                <p>Sessão ativa e token válido</p>
            </div>

            <div class="stat-card">
                <h3>Email Cadastrado</h3>
                <div class="stat-value">📧</div>
                <p>{{ $user->email }}</p>
            </div>

            <div class="stat-card">
                <h3>Último Login</h3>
                <div class="stat-value">🕐</div>
                <p>{{ $user->updated_at->format('d/m/Y H:i') }}</p>
            </div>

            <div class="stat-card">
                <h3>Segurança</h3>
                <div class="stat-value">🔐</div>
                <p>Token de sessão protegido</p>
            </div>
        </div>

        <div class="content-section">
            <h3>Informações da Sessão</h3>
            <p>Este é o painel principal do sistema. Sua sessão está protegida por um token único que é validado a cada página que você acessa.</p>

            <div class="token-info">
                <strong>Como funciona a segurança:</strong>
                <ul style="margin: 0.5rem 0; padding-left: 1.5rem;">
                    <li>Cada login gera um token único no banco de dados</li>
                    <li>O token expira em 24 horas automaticamente</li>
                    <li>Todas as páginas verificam a validade do token</li>
                    <li>No logout, o token é removido do banco</li>
                </ul>
            </div>

            <p>Navegue pelas páginas do sistema - todas estão protegidas pelo middleware de autenticação que verifica seu token a cada requisição.</p>
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
