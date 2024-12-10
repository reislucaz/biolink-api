
# ❤️ Bio Link - API

Este é o código do back-end do **Bio Link**, um aplicativo de gerenciamento de Doação de Órgãos.

---

## 🚀 Tecnologias

- [PHP](https://www.php.net)
- [Laravel](https://laravel.com)
- [MySQL](https://www.mysql.com)
- [Composer](https://getcomposer.org)

---

## 📦 Instalação

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/reislucaz/biolink-api.git
   cd biolink-api
   ```

2. **Instale as dependências:**
   Certifique-se de ter o [Composer](https://getcomposer.org) instalado e execute:
   ```bash
   composer install
   ```

3. **Configure o ambiente:**
   Renomeie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente, especialmente as do banco de dados.

   ```bash
   cp .env.example .env
   ```

4. **Gere a chave da aplicação:**
   ```bash
   php artisan key:generate
   ```

3. **Suba os containers da aplicação:**
   Suba os containers da aplicação, como o banco de dados por exemplo, rodando o comando a seguir:

   ```bash
   docker compose up -d
   ```

5. **Execute as migrações:**
   Certifique-se de que o banco de dados está configurado corretamente e execute:
   ```bash
   php artisan migrate
   ```

---

## 🚦 Execução

Para executar o servidor local, use o comando abaixo:

```bash
php artisan serve
```

O projeto estará disponível em: [http://localhost:8000](http://localhost:8000)

---

## 🛠 Requisitos

Certifique-se de ter as seguintes ferramentas instaladas:

- [PHP](https://www.php.net) >= 8.0
- [Composer](https://getcomposer.org)
- [MySQL](https://www.mysql.com) ou qualquer banco de dados compatível com Laravel
- Extensões PHP: `pdo`, `mbstring`, `openssl`, `json`

---

## Integrantes

- Lucas Reis
- Millena
- Lídia
- Jennifer
- Letícia Reis
- Diego Mesquita
- Gustavo Antunes
- Gustavo Bertonsin
