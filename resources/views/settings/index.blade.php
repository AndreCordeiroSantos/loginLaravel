<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações - Sistema</title>
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
            max-width: 1000px;
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

        .settings-grid {
            display: grid;
            gap: 2rem;
        }

        .settings-section {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .settings-section h3 {
            color: #333;
            margin-bottom: 1rem;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-item {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 10px;
            border-left: 4px solid #667eea;
        }

        .stat-item h4 {
            color: #333;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .stat-item p {
            color: #667eea;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin-right: 1rem;
            margin-bottom: 0.5rem;
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

        .btn-warning {
            background: #ffc107;
            color: #212529;
        }

        .btn-warning:hover {
            background: #e0a800;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
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

        .token-display {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            border: 1px solid #e9ecef;
            margin: 1rem 0;
            font-family: 'Courier New', monospace;
            font-size: 0.85rem;
            word-break: break-all;
        }

        .security-warning {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 1rem;
            border-radius: 8px;
            margin: 1rem 0;
        }

        @media (max-width: 768px) {
            .navbar-content {
                flex-direction: column;
                gap: 1rem;
            }

            .container {
                padding: 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .btn {
                width: 100%;
                margin-right: 0;
                text-align: center;
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
            <a href="{{ route('dashboard') }}">Dashboard</a> / Configurações
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        <div class="settings-grid">
            <!-- Informações da Conta -->
            <div class="settings-section">
                <h3>📊 Informações da Conta</h3>
                <div class="stats-grid">
                    <div class="stat-item">
                        <h4>Idade da Conta</h4>
                        <p>{{ $accountAge }} dias</p>
                    </div>
                    <div class="stat-item">
                        <h4>Último Login</h4>
                        <p>{{ $lastLogin->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="stat-item">
                        <h4>Token Expira</h4>
                        <p>{{ $tokenExpiry ? $tokenExpiry->format('d/m/Y H:i') : 'N/A' }}</p>
                    </div>
                    <div class="stat-item">
                        <h4>Status</h4>
                        <p style="color: #28a745;">✓ Ativo</p>
                    </div>
                </div>
            </div>

            <!-- Segurança da Sessão -->
            <div class="settings-section">
                <h3>🔐 Segurança da Sessão</h3>
                <p style="margin-bottom: 1rem; color: #666;">
                    Gerencie suas sessões ativas e tokens de autenticação.
                </p>

                <div class="security-warning">
                    <strong>⚠️ Atenção:</strong> Estender a sessão ou revogar tokens afetará sua experiência de login.
                </div>

                <a href="{{ route('settings.extend-session') }}" class="btn btn-primary">
                    🕐 Estender Sessão (+24h)
                </a>

                <a href="{{ route('settings.revoke-tokens') }}" class="btn btn-danger"
                   onclick="return confirm('Isso irá desconectá-lo de todos os dispositivos. Continuar?')">
                    🚫 Revogar Todos os Acessos
                </a>
            </div>

            <!-- Preferências -->
            <div class="settings-section">
                <h3>⚙️ Preferências</h3>
                <form method="POST" action="{{ route('settings.notifications') }}">
                    @csrf
                    <div style="margin-bottom: 1rem;">
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                            <input type="checkbox" name="email_notifications" checked>
                            <span>Receber notificações por email</span>
                        </label>
                    </div>

                    <div style="margin-bottom: 1rem;">
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                            <input type="checkbox" name="security_alerts" checked>
                            <span>Alertas de segurança</span>
                        </label>
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                            <input type="checkbox" name="marketing_emails">
                            <span>Emails promocionais</span>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-secondary">
                        💾 Salvar Preferências
                    </button>
                </form>
            </div>

            <!-- Exportar Dados -->
            <div class="settings-section">
                <h3>📄 Exportar Dados (LGPD)</h3>
                <p style="margin-bottom: 1rem; color: #666;">
                    Baixe uma cópia de todos os seus dados pessoais armazenados no sistema.
                </p>

                <a href="{{ route('settings.export-data') }}" class="btn btn-warning">
                    📥 Baixar Meus Dados
                </a>
            </div>

            <!-- Informações Técnicas -->
            <div class="settings-section">
                <h3>🔧 Informações Técnicas</h3>
                <div style="margin-bottom: 1rem;">
                    <h4 style="margin-bottom: 0.5rem;">Token de Sessão Atual:</h4>
                    <div class="token-display">
                        {{ substr($user->login_token, 0, 20) }}...{{ substr($user->login_token, -10) }}
                    </div>
                    <small style="color: #666;">
                        Token truncado por segurança. Expira em: {{ $tokenExpiry ? $tokenExpiry->diffForHumans() : 'N/A' }}
                    </small>
                </div>

                <div style="margin-bottom: 1rem;">
                    <h4 style="margin-bottom: 0.5rem;">ID do Usuário:</h4>
                    <div class="token-display">{{ $user->id }}</div>
                </div>

                <div>
                    <h4 style="margin-bottom: 0.5rem;">Última Atualização:</h4>
                    <div class="token-display">{{ $user->updated_at->format('d/m/Y H:i:s') }}</div>
                </div>
            </div>

            <!-- Zona de Perigo -->
            <div class="settings-section" style="border: 2px solid #dc3545;">
                <h3 style="color: #dc3545;">⚠️ Zona de Perigo</h3>
                <p style="margin-bottom: 1rem; color: #666;">
                    Ações irreversíveis que afetam permanentemente sua conta.
                </p>

                <div class="security-warning" style="background: #f8d7da; border-color: #f5c6cb; color: #721c24;">
                    <strong>Aviso:</strong> Estas ações não podem ser desfeitas.
                </div>

                <button class="btn btn-danger" onclick="alert('Funcionalidade em desenvolvimento')">
                    🗑️ Excluir Conta Permanentemente
                </button>
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
