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

## ⚙️ Integração e Entrega Contínua (CI/CD) com GitHub Actions

Este projeto utiliza **GitHub Actions** para implementar **Integração Contínua (CI)** e **Entrega Contínua (CD)**, garantindo qualidade de código e automação total do deploy em ambientes de staging e produção.

### Integração Contínua (CI)

A cada push nas branches `main` e `develop`, o pipeline executa automaticamente:

- **Checkout** do repositório
- **Configuração de ambiente**:
  - PHP 8.2 para o backend (Laravel)
  - Node.js 20 para o frontend (Vue.js)
- **Instalação de dependências**:
  - `composer install` para o Laravel
  - `npm install` para o Vue
- **Execução de testes unitários**:
  - `php artisan test` para a API
  - `npm run test` com Vitest no front
- O CI **falha automaticamente se qualquer teste falhar**, bloqueando o deploy

### Entrega Contínua (CD)

Após os testes, o workflow executa o **deploy automático na AWS** com base na branch:

#### Ambiente de Staging (`develop`)
- Push em `develop` aciona:
  - Execução dos testes
  - Deploy automático para o servidor de staging (EC2 AWS)
  - Atualização com: `composer install`, `php artisan migrate`, `npm run build`

#### Ambiente de Produção (`main`)
- Push em `main` aciona:
  - Execução dos testes
  - Deploy automático para o servidor de produção (EC2 AWS)
  - Uso de secrets: `AWS_PROD_HOST`, `AWS_PROD_USER`, `AWS_PROD_SSH_KEY`

Com essa configuração, o projeto entrega um fluxo confiável de desenvolvimento até produção, com qualidade validada automaticamente em cada etapa.

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

## 📄 Licença

Este projeto está sob licença MIT. Veja o arquivo `LICENSE`.

## 🤖 Autor

Desenvolvido por **Emerson Okopnik**\
Contato: [emer00k@gmail.com](mailto\:emer00k@gmail.com)

