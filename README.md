# Sistema de Gestão Veterinária

Sistema completo para gestão de clínicas veterinárias, desenvolvido com Laravel (backend) e Vue.js (frontend).

## 🚀 Funcionalidades

### Autenticação e Autorização

- Login/logout com JWT
- Cadastro de usuários
- Perfis de acesso: administrador, recepcionista, veterinário

### Gestão de Clientes e Pets

- Cadastro completo de clientes (tutores)
- Cadastro de pets com vínculo ao cliente
- Listagem e busca avançada

### Consultas

- Agendamento de consultas
- Histórico por pet
- Atribuição de veterinário
- Status: agendada, em andamento, concluída, cancelada

### Relatórios

- Atendimentos por período
- Consultas por veterinário
- Pets atendidos por cliente
- Dashboard com estatísticas gerais

## 🛠️ Tecnologias

### Backend (Laravel)

- Laravel 11+
- JWT Auth
- Eloquent ORM
- API Resources
- Migrations e Seeders

### Frontend (Vue.js)

- Vue 3 (Composition API)
- Vue Router
- Pinia (estado global)
- Axios (requisições HTTP)
- Tailwind CSS (estilização)

## 📆 Instalação

### Backend

```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
```

Configure seu `.env` com:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=vetclinica
DB_USERNAME=postgres
DB_PASSWORD=
```

Depois:

```bash
php artisan migrate
composer require tymon/jwt-auth
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
php artisan jwt:secret
php artisan db:seed # opcional
php artisan serve
```

### Frontend

```bash
cd frontend
npm install
cp .env.example .env
npm run dev
```

## 📱 Uso

1. Acesse `http://localhost:3000`
2. Realize login ou registre um novo usuário
3. Navegue pelo sistema via menu lateral

## 🔮 Testes

### Backend

```bash
php artisan test
```

### Frontend

```bash
npm run test
```

## 📃 API (principais endpoints)

- `POST /api/login` - Login
- `POST /api/register` - Registro
- `GET /api/clients` - Listar clientes
- `POST /api/clients` - Criar cliente
- `GET /api/pets` - Listar pets
- `POST /api/appointments` - Criar consulta
- `GET /api/reports/dashboard-stats` - Estatísticas

## 📬 Coleção Postman

Para facilitar os testes da API, importe o arquivo
`documentos/clinica-veterinaria.postman_collection.json` no Postman.
Defina a variável `baseUrl` com a URL do backend (ex.: `http://localhost:8000`)
e utilize a variável `token` após autenticar-se.

## 👥 Contribuição

1. Fork o projeto
2. Crie sua branch: `git checkout -b feature/NomeFeature`
3. Commit: `git commit -m 'Minha feature'`
4. Push: `git push origin feature/NomeFeature`
5. Abra um Pull Request

## 📄 Licença

Este projeto está sob licença MIT. Veja o arquivo `LICENSE`.

## 🤖 Autor

Desenvolvido por **Emerson Okopnik**\
Contato: [emer00k@gmail.com](mailto\:emer00k@gmail.com)

