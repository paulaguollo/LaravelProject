# Grove — Laravel
### *Where impact grows.*

Grove é uma plataforma web de gestão de iniciativas sustentáveis para a comunidade, desenvolvida em **Laravel** como projeto final da disciplina de **Desenvolvimento Framework Web (Back-end)** no CESAE Digital.

A plataforma permite que utilizadores registados publiquem, editem e acompanhem iniciativas de impacto desde hortas comunitárias a campanhas de reciclagem e economia circular. Cada iniciativa pode ter eventos associados, geridos através de um CRUD completo.

---

## Funcionalidades

### Autenticação (Laravel Fortify)
- Registo de utilizadores com validação de campos
- Login e logout com gestão de sessão
- Páginas privadas protegidas por Middleware `auth`
- Perfis de utilizador definidos manualmente na base de dados (`user_type`)

### Iniciativas (CRUD completo)
- Criar, listar, editar e eliminar iniciativas
- Categorização por tipo de impacto
- Descrição e imagem associada
- Pesquisa por nome
- Visível publicamente — sem necessidade de login para visualizar

### Eventos (CRUD completo)
- Cada iniciativa pode ter múltiplos eventos associados
- Campos: nome, imagem e data de realização
- Contador de eventos visível na listagem de iniciativas
- Relação `hasMany` / `belongsTo` entre Iniciativa e Evento

### Controlo de Acesso por Perfil
- `user_type = 1` → Administrador: pode criar, editar e eliminar iniciativas e eventos
- `user_type = 2` → Utilizador autenticado: pode editar
- Não autenticado: apenas visualização

### Dashboard
- Área privada protegida por Middleware
- Mostra mensagem personalizada: *"Olá, nome do utilizador"*
- Identifica se o utilizador é administrador

### Ficheiros
- Upload e visualização de imagens em iniciativas e eventos
- Armazenamento via `Storage::putFile` na pasta `public`
- Link simbólico criado com `php artisan storage:link`

---

## Tecnologias

| Camada | Tecnologia |
|---|---|
| Framework | Laravel 13 |
| Autenticação | Laravel Fortify |
| Front-end | Blade, Bootstrap 5, CSS personalizado |
| Base de Dados | MySQL 9 |
| ORM | Eloquent |
| Controlo de Versão | Git + GitHub |
| Ambiente | PHP 8.5, Homebrew |

---

## Estrutura da Base de Dados

```
users
├── id (PK)
├── name
├── email (UNIQUE)
├── password (hashed)
├── user_type (1 = admin, 2 = user)
└── timestamps

iniciativas
├── id (PK)
├── nome
├── categoria
├── descricao
├── imagem (nullable)
└── timestamps

eventos
├── id (PK)
├── iniciativa_id (FK → iniciativas)
├── nome
├── imagem (nullable)
├── data_realizacao
└── timestamps
```

---

## Estrutura do Projeto

```
grove/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── DashboardController.php
│   │       ├── IniciativaController.php
│   │       └── EventoController.php
│   ├── Models/
│   │   ├── Iniciativa.php
│   │   └── Evento.php
│   ├── Actions/Fortify/
│   │   └── CreateNewUser.php
│   └── Providers/
│       └── FortifyServiceProvider.php
├── database/migrations/
│   ├── ..._create_users_table.php
│   ├── ..._add_role_to_users_table.php
│   ├── ..._create_iniciativas_table.php
│   └── ..._create_eventos_table.php
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php          # Layout master
│   ├── auth/
│   │   ├── login.blade.php
│   │   └── register.blade.php
│   ├── iniciativas/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   └── edit.blade.php
│   ├── eventos/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   └── edit.blade.php
│   ├── dashboard.blade.php
│   └── about.blade.php
├── routes/
│   └── web.php
├── public/
│   ├── css/style.css
│   └── img/
└── config/
    └── fortify.php
```

---

## Instalação Local

### Requisitos
- PHP 8.x
- MySQL 9.x
- Composer

### Passos

1. Clonar o repositório:
```bash
git clone https://github.com/paulaguollo/LaravelProject.git
cd grove
```

2. Instalar dependências:
```bash
composer install
```

3. Configurar o ambiente:
```bash
cp .env.example .env
php artisan key:generate
```

4. Editar `.env` com os dados da base de dados:
```
DB_DATABASE=laravelproject
DB_USERNAME=root
DB_PASSWORD=
```

5. Criar a base de dados e correr as migrations:
```bash
mysql -u root -p -e "CREATE DATABASE laravelproject;"
php artisan migrate
```

6. Criar o link de storage:
```bash
php artisan storage:link
```

7. Iniciar o servidor:
```bash
php artisan serve
```

8. Abrir no browser: `http://localhost:8000`

### Configurar utilizador admin

Após registar uma conta, definir manualmente o perfil de administrador:
```bash
mysql -u root -p
```
```sql
USE laravelproject;
UPDATE users SET user_type = 1 WHERE email = 'o_teu_email@exemplo.com';
```

---

## Critérios de Avaliação

| Critério | Implementação |
|---|---|
| Gerar aplicação e configurar BD | `composer create-project`, `.env`, MySQL |
| Layout master e extensão | `layouts/app.blade.php` com `@yield` e `@extends` |
| Rotas com controllers | `routes/web.php` com `Route::get/post/put/delete` |
| Migrações | 3 migrations: users, iniciativas, eventos |
| CRUD completo | Iniciativas e Eventos com create/store/edit/update/destroy |
| Sistema de Login | Laravel Fortify com register e login |
| Middleware | `Route::middleware(['auth'])` nas rotas privadas |
| Bloqueio por perfil na Blade | `@auth`, `@if(Auth::user()->user_type == 1)` |
| Guardar e visualizar ficheiro | Upload de imagem com `Storage::putFile`, visualização com `asset('storage/...')` |
| Funcionalidade extra | Contador de eventos por iniciativa + página About + pesquisa |

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
