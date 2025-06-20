# Sistema de Gestão Veterinária

Sistema completo para gestão de clínicas veterinárias desenvolvido com Laravel (backend) e Vue.js (frontend).

## 🚀 Funcionalidades

### Autenticação e Autorização
- Login/logout com JWT
- Cadastro de usuários
- Perfis: administrador, recepcionista, veterinário

### Gestão de Clientes e Pets
- Cadastro completo de clientes (tutores)
- Cadastro de pets com vínculo ao cliente
- Listagem e busca avançada

### Consultas
- Agendamento de consultas
- Histórico completo de consultas por pet
- Atribuição de veterinário à consulta
- Controle de status (agendada, em andamento, concluída, cancelada)

### Relatórios
- Total de atendimentos por período
- Consultas por veterinário
- Pets atendidos por cliente
- Dashboard com estatísticas

## 🛠️ Tecnologias

### Backend (Laravel)
- Laravel 11+
- JWT para autenticação
- Eloquent ORM
- API Resources
- Migrations e Seeders

### Frontend (Vue.js)
- Vue 3 (Composition API)
- Vue Router
- Pinia (gerenciamento de estado)
- Axios (comunicação com API)
- TailwindCSS (UI)

## 📦 Instalação

### Backend

1. Clone o repositório e navegue para a pasta backend:
\`\`\`bash
cd backend
\`\`\`

2. Instale as dependências:
\`\`\`bash
composer install
\`\`\`

3. Configure o arquivo `.env`:
\`\`\`bash
cp .env.example .env
php artisan key:generate
\`\`\`

4. Configure o banco de dados no `.env`:
\`\`\`env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=vetclinica
DB_USERNAME=postgres
DB_PASSWORD=
\`\`\`

5. Execute as migrations:
\`\`\`bash
php artisan migrate
\`\`\`

6. Instale e configure o JWT:
\`\`\`bash
composer require tymon/jwt-auth
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
php artisan jwt:secret
\`\`\`

7. Execute os seeders (opcional):
\`\`\`bash
php artisan db:seed
\`\`\`

8. Inicie o servidor:
\`\`\`bash
php artisan serve
\`\`\`

### Frontend

1. Navegue para a pasta frontend:
\`\`\`bash
cd frontend
\`\`\`

2. Instale as dependências:
\`\`\`bash
npm install
\`\`\`

3. Configure o arquivo `.env`:
\`\`\`bash
cp .env.example .env
\`\`\`

4. Inicie o servidor de desenvolvimento:
\`\`\`bash
npm run dev
\`\`\`

## 🔧 Configuração

### JWT Configuration

No arquivo `config/jwt.php`, configure:

\`\`\`php
'ttl' => 60, // Token expiration time in minutes
'refresh_ttl' => 20160, // Refresh token expiration time in minutes
\`\`\`

## 📱 Uso

1. Acesse o frontend em `http://localhost:3000`
2. Faça login com as credenciais padrão ou registre um novo usuário
3. Navegue pelas funcionalidades através do menu lateral

## 🧪 Testes

### Backend
\`\`\`bash
php artisan test
\`\`\`

### Frontend
\`\`\`bash
npm run test
\`\`\`

## 📚 API Documentation

A API segue padrões RESTful. Principais endpoints:

- `POST /api/login` - Autenticação
- `GET /api/clients` - Listar clientes
- `POST /api/clients` - Criar cliente
- `GET /api/pets` - Listar pets
- `POST /api/appointments` - Criar consulta
- `GET /api/reports/dashboard-stats` - Estatísticas do dashboard

## 🤝 Contribuição

1. Fork o projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

## 🧑‍💻 Autor

Desenvolvido por Emerson Okopnik

Contato: emer00k@gmail.com
