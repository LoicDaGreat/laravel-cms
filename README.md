# 💰 Budgeting App

A full-stack personal finance and budgeting application built with **Laravel 13**, **React 19**, **Inertia.js**, and **TypeScript**. Track income and expenses, manage budgets, set savings goals, and gain insights into your spending habits — all from a clean, responsive UI.

---

## 🧱 Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP 8.3 · Laravel 13 · Laravel Fortify |
| Frontend | React 19 · TypeScript · Inertia.js v3 |
| Styling | Tailwind CSS v4 · Radix UI · shadcn/ui |
| Build Tool | Vite 8 |
| ORM | Eloquent |
| Auth | Laravel Fortify (2FA supported) |
| Testing | PHPUnit 12 |
| Linting | Laravel Pint · ESLint · Prettier |
| Dev Tools | Laravel Debugbar · Laravel Pail · Laravel Sail |

---

## ✨ Features

- 🔐 **Authentication** — Register, login, email verification, password reset, and two-factor authentication
- 🏦 **Accounts** — Manage multiple accounts (checking, savings, credit, cash) with live balance tracking
- 💳 **Transactions** — Log income and expenses, with search, filtering, and CSV/PDF export
- 📊 **Budgeting** — Set per-category spending budgets and track progress in real time
- 🎯 **Savings Goals** — Define goals with target amounts and deadlines, and track contributions
- 🔁 **Recurring Transactions** — Automate repetitive income/expenses (rent, salary, subscriptions)
- 📈 **Reports & Analytics** — Monthly summaries, spending by category, net worth over time, cash flow forecast
- 🌗 **Dark Mode** — Persistent dark/light mode toggle
- 📱 **Responsive Design** — Fully mobile-friendly UI

---

## 📁 Project Structure

```
laravel-cms/
├── app/
│   ├── Actions/
│   │   └── Fortify/              # User creation & password reset actions
│   ├── Concerns/                 # Shared validation rule traits
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Cms/              # Core CMS/app controllers
│   │   │   └── Settings/         # Profile & settings controllers
│   │   ├── Middleware/           # Inertia, appearance, etc.
│   │   └── Requests/             # Form request validation classes
│   ├── Models/                   # Eloquent models
│   ├── Providers/                # AppServiceProvider, FortifyServiceProvider
│   └── Services/                 # Business logic services (e.g. StressScoreService)
│
├── bootstrap/                    # App bootstrapping
├── config/                       # Laravel config files
├── database/
│   ├── factories/                # Model factories for testing
│   ├── migrations/               # Database migrations
│   └── seeders/                  # Database seeders (default categories, etc.)
│
├── public/                       # Web root (index.php, assets)
│
├── resources/
│   ├── css/                      # Global styles (app.css)
│   └── js/
│       ├── actions/              # Wayfinder-generated route actions
│       ├── components/           # Reusable React components (shadcn/ui)
│       │   └── ui/               # Base UI primitives
│       ├── hooks/                # Custom React hooks
│       ├── layouts/              # App, auth, and settings layouts
│       ├── lib/                  # Utility functions
│       ├── pages/                # Inertia page components
│       │   ├── auth/             # Login, register, password reset pages
│       │   └── settings/         # Profile & settings pages
│       ├── routes/               # Wayfinder typed route definitions
│       ├── types/                # TypeScript type definitions
│       └── app.tsx               # React app entry point
│
├── routes/
│   ├── web.php                   # Web routes
│   ├── settings.php              # Settings routes
│   └── console.php               # Scheduled commands
│
├── storage/                      # Logs, cache, compiled views
├── tests/
│   ├── Feature/                  # Feature tests (auth, settings, etc.)
│   └── Unit/                     # Unit tests
│
├── .github/
│   └── workflows/
│       ├── lint.yml              # CI: linting
│       └── tests.yml             # CI: test suite
│
├── .env.example                  # Environment variable template
├── composer.json                 # PHP dependencies
├── package.json                  # Node dependencies
├── vite.config.ts                # Vite build config
├── tsconfig.json                 # TypeScript config
├── pint.json                     # Laravel Pint config
├── phpunit.xml                   # PHPUnit config
└── eslint.config.js              # ESLint config
```

---

## 🚀 Getting Started

### Prerequisites

- **PHP** >= 8.3
- **Composer** >= 2.x
- **Node.js** >= 20.x & **npm** / **pnpm**
- **MySQL** >= 8.0 (or SQLite for local dev)
- **Laravel Herd** (recommended for local dev on macOS/Windows)

---

### Installation

**1. Clone the repository**

```bash
git clone https://github.com/your-username/budgeting-app.git
cd budgeting-app
```

**2. Install PHP dependencies**

```bash
composer install
```

**3. Install Node dependencies**

```bash
npm install
# or
pnpm install
```

**4. Set up your environment**

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` with your database credentials and any API keys:

```env
APP_NAME="Budgeting App"
APP_URL=http://budgeting-app.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=budgeting_app
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
```

**5. Run migrations & seeders**

```bash
php artisan migrate
php artisan db:seed
```

**6. Build frontend assets**

```bash
npm run build
# or for development
npm run dev
```

**7. Start the development server**

```bash
composer run dev
```

This starts all dev processes concurrently: Laravel server, queue worker, log watcher (Pail), and Vite.

> The app will be available at **http://localhost:8000** or your configured Herd domain.

---

## 🧪 Testing

Run the full test suite:

```bash
php artisan test
```

Run with coverage:

```bash
php artisan test --coverage
```

Run only feature or unit tests:

```bash
php artisan test --testsuite=Feature
php artisan test --testsuite=Unit
```

---

## 🔍 Linting & Formatting

**PHP (Laravel Pint):**

```bash
composer run lint          # Auto-fix
composer run lint:check    # Check only (CI mode)
```

**JavaScript/TypeScript (ESLint + Prettier):**

```bash
npm run lint               # Auto-fix ESLint issues
npm run lint:check         # Check only
npm run format             # Auto-format with Prettier
npm run format:check       # Check only
npm run types:check        # TypeScript type checking
```

**Run all CI checks at once:**

```bash
composer run ci:check
```

---

## ⚙️ Environment Variables

| Variable | Description | Default |
|---|---|---|
| `APP_NAME` | Application name | `Budgeting App` |
| `APP_KEY` | Laravel app encryption key | *(generated)* |
| `APP_URL` | Application base URL | `http://localhost` |
| `DB_CONNECTION` | Database driver | `mysql` |
| `DB_DATABASE` | Database name | `budgeting_app` |
| `MAIL_MAILER` | Mail driver (smtp, log, etc.) | `log` |
| `QUEUE_CONNECTION` | Queue driver | `sync` |

---

## 🗂️ Key Routes

| Method | URI | Description |
|---|---|---|
| `GET` | `/` | Welcome / landing page |
| `GET` | `/dashboard` | Main app dashboard |
| `POST` | `/register` | User registration |
| `POST` | `/login` | User login |
| `GET` | `/settings/profile` | Profile settings |
| `GET` | `/settings/security` | Security (2FA) settings |
| `GET` | `/settings/appearance` | Theme & appearance |

---

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/my-feature`
3. Commit your changes: `git commit -m "feat: add my feature"`
4. Push to your branch: `git push origin feature/my-feature`
5. Open a Pull Request

Please ensure all tests pass and linting checks are clean before opening a PR.

---

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).
