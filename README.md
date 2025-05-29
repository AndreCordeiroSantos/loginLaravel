# 🔐 Sistema de Login Seguro - Laravel

Sistema completo de autenticação com foco em segurança, desenvolvido em Laravel com validação de token personalizada e múltiplas camadas de proteção.

## 📋 Índice

- [Características Principais](#-características-principais)
- [Requisitos](#-requisitos)
- [Instalação](#-instalação)
- [Configuração](#-configuração)
- [Estrutura do Sistema](#-estrutura-do-sistema)
- [Funcionalidades](#-funcionalidades)
- [Segurança Implementada](#-segurança-implementada)
- [Comandos Úteis](#-comandos-úteis)
- [API de Rotas](#-api-de-rotas)
- [Troubleshooting](#-troubleshooting)

## 🌟 Características Principais

- ✅ **Autenticação baseada em tokens únicos** armazenados no banco
- ✅ **Rate limiting** contra ataques de força bruta
- ✅ **Headers de segurança** (XSS, Clickjacking, CSP)
- ✅ **Interface moderna e responsiva**
- ✅ **Logs de segurança** completos
- ✅ **Gestão de perfil e configurações**
- ✅ **Compliance LGPD** (exportação de dados)
- ✅ **Session security** com regeneração de IDs
- ✅ **Validações robustas** e sanitização de dados

## 🛠 Requisitos

- PHP 8.1+
- Laravel 10+
- MySQL 5.7+ / PostgreSQL
- Composer
- Node.js (opcional, para assets)

## 🚀 Instalação

### 1. Clone e Configure o Projeto

```bash
# Clone o repositório
git clone https://github.com/seu-usuario/sistema-login-seguro.git
cd sistema-login-seguro

# Instale as dependências
composer install

# Copie o arquivo de ambiente
cp .env.example .env

# Gere a chave da aplicação
php artisan key:generate
```

### 2. Configure o Banco de Dados

```bash
# Edite o .env com suas configurações de banco
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_seu_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

### 3. Execute as Migrations

```bash
# Crie as tabelas necessárias
php artisan migrate

# (Opcional) Popule com dados de teste
php artisan db:seed
```

### 4. Configure Permissões

```bash
# Configure permissões (Linux/Mac)
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## ⚙️ Configuração

### 1. Variáveis de Ambiente Críticas

Edite seu arquivo `.env`:

```env
# Segurança Básica
APP_DEBUG=false
APP_ENV=production
APP_URL=https://seudominio.com

# Sessões Seguras
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=strict
SESSION_SECURE_COOKIE=true

# Rate Limiting
THROTTLE_REQUESTS=60
THROTTLE_DECAY_MINUTES=1

# Email
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seu_email@gmail.com
MAIL_PASSWORD=sua_senha_de_app
MAIL_ENCRYPTION=tls
```

### 2. Criar Tabelas Adicionais

```bash
# Tabela de logs de segurança
php artisan make:migration create_security_logs_table

# Executar migration
php artisan migrate
```

### 3. Registrar Middlewares

Execute o comando para registrar os middlewares de segurança:

```bash
php artisan make:middleware RateLimitLogin
php artisan make:middleware SecurityHeaders
php artisan make:middleware CheckAuthToken
```

## 🏗 Estrutura do Sistema

### Arquivos Principais

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php      # Autenticação principal
│   │   ├── ProfileController.php   # Gestão de perfil
│   │   └── SettingsController.php  # Configurações
│   └── Middleware/
│       ├── CheckAuthToken.php      # Validação de token
│       ├── RateLimitLogin.php      # Rate limiting
│       └── SecurityHeaders.php     # Headers de segurança
├── Models/
│   ├── User.php                    # Model principal
│   └── SecurityLog.php             # Logs de segurança
└── Console/Commands/
    └── CleanExpiredTokens.php      # Limpeza automática

resources/views/
├── auth/
│   ├── login.blade.php             # Página de login
│   └── register.blade.php          # Página de cadastro
├── profile/
│   └── show.blade.php              # Perfil do usuário
├── settings/
│   └── index.blade.php             # Configurações
└── dashboard.blade.php             # Dashboard principal

database/migrations/
├── create_users_table.php          # Tabela de usuários
└── create_security_logs_table.php  # Logs de segurança
```

## 🎯 Funcionalidades

### 1. Sistema de Autenticação

- **Login**: Email + senha (mínimo 6 caracteres)
- **Cadastro**: Nome, email único, confirmação de senha
- **Token único**: Gerado a cada login, expira em 24h
- **Logout**: Remove token do banco e limpa sessão

### 2. Gestão de Perfil

- **Atualizar dados**: Nome e email
- **Alterar senha**: Com verificação da senha atual
- **Avatar visual**: Inicial do nome do usuário

### 3. Configurações Avançadas

- **Estender sessão**: +24 horas de validade
- **Revogar acessos**: Logout forçado de todos os dispositivos
- **Exportar dados**: Compliance LGPD
- **Preferências**: Notificações e alertas

### 4. Dashboard

- **Informações da conta**: Status, último login, etc.
- **Navegação intuitiva**: Dropdown com menu
- **Interface responsiva**: Mobile-first design

## 🛡 Segurança Implementada

### 1. Rate Limiting

```php
// Proteção contra força bruta
- 5 tentativas por IP por minuto
- 3 tentativas por email com bloqueio de 5 minutos
- Limpeza automática em login bem-sucedido
```

### 2. Headers de Segurança

```http
X-Content-Type-Options: nosniff
X-Frame-Options: DENY
X-XSS-Protection: 1; mode=block
Content-Security-Policy: default-src 'self'
Referrer-Policy: strict-origin-when-cross-origin
```

### 3. Session Security

- **Session ID regeneration**: A cada login
- **HttpOnly cookies**: Proteção contra XSS
- **Secure cookies**: Apenas HTTPS
- **SameSite**: Proteção CSRF

### 4. Token Management

- **Token único**: Um por usuário
- **Expiração automática**: 24 horas
- **Validação rigorosa**: A cada requisição
- **Limpeza automática**: Tokens expirados

### 5. Logs de Segurança

```php
// Eventos registrados
- Login bem-sucedido
- Tentativas falhadas
- Tokens inválidos
- IPs suspeitos
- Atividades anômalas
```

## 🔧 Comandos Úteis

### Instalação e Setup

```bash
# Configuração inicial completa
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

### Gerenciamento de Tokens

```bash
# Limpar tokens expirados manualmente
php artisan auth:clean-tokens

# Ver tokens ativos
php artisan tinker
>>> User::whereNotNull('login_token')->count()
```

### Logs e Debug

```bash
# Ver logs de segurança
tail -f storage/logs/laravel.log

# Limpar cache de configuração
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Comandos de Manutenção

```bash
# Criar comando personalizado
php artisan make:command CleanExpiredTokens

# Agendar limpeza automática (adicionar ao cron)
* * * * * cd /caminho/do/projeto && php artisan schedule:run >> /dev/null 2>&1
```

## 🌐 API de Rotas

### Rotas Públicas (sem autenticação)

```php
GET  /                    # Redireciona para login
GET  /login              # Página de login
POST /login              # Processar login
GET  /register           # Página de cadastro  
POST /register           # Processar cadastro
GET  /logout             # Logout (remove token)
```

### Rotas Protegidas (requer token válido)

```php
GET  /dashboard          # Dashboard principal
GET  /profile            # Página de perfil
PUT  /profile            # Atualizar dados pessoais
PUT  /profile/password   # Alterar senha
GET  /settings           # Configurações
POST /settings/notifications    # Salvar preferências
GET  /settings/extend-session   # Estender token
GET  /settings/revoke-tokens    # Revogar todos os acessos
GET  /settings/export-data      # Baixar dados (LGPD)
```

## 🔍 Troubleshooting

### Problemas Comuns

#### 1. Erro "Session store not set"

```bash
# Solução
php artisan session:table
php artisan migrate
```

#### 2. Token sempre inválido

```bash
# Verificar configuração de sessão
php artisan config:clear
# Verificar permissões de storage
chmod -R 755 storage
```

#### 3. Rate limiting muito restritivo

```php
// Ajustar em RateLimitLogin.php
RateLimiter::tooManyAttempts($key, 10); // Era 5, agora 10
```

#### 4. Erro de CSRF Token

```html
<!-- Verificar se tem @csrf em todos os forms -->
<form method="POST">
    @csrf
    <!-- campos do form -->
</form>
```

### Debug Avançado

#### Ver sessões ativas

```bash
php artisan tinker
>>> session()->all()
>>> User::whereNotNull('login_token')->get()
```

#### Verificar logs de segurança

```sql
-- Via MySQL
SELECT * FROM security_logs ORDER BY created_at DESC LIMIT 10;
```

#### Testar rate limiting

```bash
# Use curl para testar múltiplas tentativas
for i in {1..6}; do 
  curl -X POST http://localhost:8000/login \
    -d "email=test@test.com&password=wrong"
done
```

### Performance

#### Otimizar banco de dados

```sql
-- Índices recomendados
CREATE INDEX idx_users_token ON users(login_token);
CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_security_logs_user ON security_logs(user_id, created_at);
```

#### Limpeza automática

```bash
# Adicionar ao crontab
0 */6 * * * cd /var/www/projeto && php artisan auth:clean-tokens
0 2 * * * cd /var/www/projeto && php artisan auth:clean-old-logs
```

## 📚 Comandos de Desenvolvimento

### Criar novos componentes

```bash
# Controller
php artisan make:controller NomeController

# Model com migration
php artisan make:model NomeModel -m

# Middleware
php artisan make:middleware NomeMiddleware

# Request com validação
php artisan make:request NomeRequest

# Command personalizado
php artisan make:command NomeCommand
```

### Testes

```bash
# Executar testes
php artisan test

# Teste específico
php artisan test --filter=LoginTest

# Coverage
php artisan test --coverage
```

## 🚀 Deploy em Produção

### 1. Servidor Web

```nginx
# Configuração Nginx
server {
    listen 443 ssl http2;
    server_name seudominio.com;
    
    ssl_certificate /path/to/certificate.crt;
    ssl_certificate_key /path/to/private.key;
    
    root /var/www/projeto/public;
    index index.php;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
    }
}
```

### 2. Otimizações

```bash
# Cache de configuração
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Otimização do Composer
composer install --optimize-autoloader --no-dev
```

### 3. Monitoramento

```bash
# Log rotation
/var/www/projeto/storage/logs/*.log {
    daily
    rotate 30
    compress
    delaycompress
    create 644 www-data www-data
}
```

## 📄 Licença

Este projeto está licenciado sob a MIT License - veja o arquivo [LICENSE.md](LICENSE.md) para detalhes.

## 🤝 Contribuição

1. Fork o projeto
2. Crie sua feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📞 Suporte

- **Documentação**: [Laravel Documentation](https://laravel.com/docs)
- **Bugs**: Reporte problemas pelo email
- **Email**: andrecordeiro.inf@gmail.com

---

**⚠️ Importante**: Sempre teste em ambiente de desenvolvimento antes de aplicar em produção. Mantenha backups regulares e monitore os logs de segurança.

---

*Desenvolvido com ❤️ usando Laravel*
