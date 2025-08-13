# 🧠 Suggestion Generator API (Laravel)

This is the backend for the Suggestion Generator app, built with Laravel. It exposes a simple API endpoint that returns content suggestions based on OpenAI (simulating the OpenAI respones).

---

## 🚀 Getting Started

### 1. Clone the repository

```bash
git clone https://github.com/jsandovalz/suggestion-generator-backend.git
cd suggestion-generator-backend

```

### 2. Install dependencies
```bash
composer install
```

### 3. Set up environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Start the server

```bash
php artisan serve
```

## 📦 API Endpoint
```bash
POST /api/suggestions
{
  "prompt": "local election"
}

Response:

{
  "suggestions": [
    "Candidate profiles",
    "Impact on local economy",
    "Voter turnout trends"
  ]
}
```

## 🧪 Running Unit Tests

This project includes a unit test for the SuggestionController.

```bash
php artisan test
```


## 📁 Project Structure
```bash
app/
└── Http/
    └── Controllers/
        └── SuggestionController.php
routes/
└── api.php
tests/
└── Unit/
    └── SuggestionControllerTest.php

```
