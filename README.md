# Grem

**Grem** is an academic gaming portal project built during an internship for browsing games, news, reviews, tags, genres, platforms, developers, and publishers.

The project is built as a full-stack web application with a Symfony backend, a React / Next.js frontend, MySQL persistence, Docker Compose infrastructure, and an EasyAdmin back office.

## Project Overview

Grem demonstrates a classic full-stack content portal architecture created as an academic internship project:

- Public users browse published games, news, reviews, and metadata pages.
- Authenticated users can sign in, keep a session through a cookie, and view their profile.
- Administrators manage content through EasyAdmin and protected API endpoints.
- The frontend consumes the backend through JSON API endpoints.

## Tech Stack

- PHP 8.3
- Symfony 7
- Doctrine ORM
- EasyAdmin
- NelmioApiDocBundle
- MySQL
- Next.js 15
- React 19
- TypeScript
- Tailwind CSS
- Docker Compose
- Apache

## Project Structure

```text
Grem/
|-- backend/
|   |-- config/
|   |-- migrations/
|   |-- public/
|   `-- src/
|       |-- Controller/
|       |-- Entity/
|       |-- Repository/
|       |-- Security/
|       `-- Service/
|-- frontend/
|   `-- app/
|       |-- (routes)/
|       |-- components/
|       |-- lib/
|       `-- ui/
|-- docker/
|-- docs/
`-- docker-compose.yaml
```

## Authentication

Grem uses custom session-token authentication.

1. `POST /api/login` validates email and password.
2. The backend creates a `UserToken` record.
3. The response sets an HttpOnly `session_id` cookie.
4. Protected API routes use `TokenAuthenticator` to validate the cookie.
5. `POST /api/logout` revokes the token and clears the cookie.

JWT keys are still required locally because the token service creates a JWT string before storing the session token, but browser authentication is based on the `session_id` cookie.

## Main Features

- Browse game catalog pages.
- Browse news articles.
- Browse reviews.
- Browse metadata pages for genres, tags, platforms, developers, and publishers.
- Resolve public pages by slug.
- Sign in and view the authenticated profile.
- Manage games, news, reviews, comments, users, and metadata through EasyAdmin.
- Use Swagger UI at `/api/doc`.

## Documentation

1. Product and Analysis
   1. [Target Audience](docs/target-audience.md)
   2. [Functional Requirements](docs/functional-requirements.md)
   3. [Use Cases](docs/use-cases.md)

2. Architecture and API
   1. [API Description](docs/api-description.md)
   2. [Data Model](docs/data-model.md)
   3. [Architecture Diagrams](docs/architecture-diagrams.md)
