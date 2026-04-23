# API Description

## 1. Entities

### User

| Field | Business Description | Example Value |
|------|----------------------|---------------|
| id | Unique user identifier | `1` |
| email | User email address and login identifier | `brie@gmail.com` |
| password | Hashed password | `$2y$...` |
| roles | Symfony security roles | `["ROLE_ADMIN", "ROLE_USER"]` |
| nickname | Public user nickname | `Brie` |
| twitchAccount | Optional Twitch profile URL | `http://example.com` |
| avatar | Avatar filename | `avatar.jpg` |
| createdAt | Creation date | `2025-04-01 13:11:14` |
| updatedAt | Last update date | `2025-04-01 13:11:14` |

### UserToken

| Field | Business Description | Example Value |
|------|----------------------|---------------|
| id | Unique token record identifier | `1` |
| user | Token owner | `User#1` |
| token | Stored JWT string | `eyJ...` |
| sessionId | Cookie session identifier | `85372366-28f0-4778-8143-cab4dda3b223` |
| expiresAt | Expiration date | `2026-04-24 18:00:00` |
| isRevoked | Revocation flag | `false` |

### Game

| Field | Business Description | Example Value |
|------|----------------------|---------------|
| id | Unique game identifier | `12` |
| title | Game title | `Silent Hill 2 Remake` |
| status | Publication status | `Published` |
| slug | Public route identifier | `silent-hill-2-remake` |
| content | Full game description | HTML or text |
| summary | Short summary | HTML or text |
| releaseDateWorld | World release date | `2024-10-08` |
| releaseDateFrance | France release date | `2024-10-08` |
| platformRequirementsLevel | Requirements enum | `Medium` |
| ageRating | Age rating enum | `PEGI_18` |
| cover | Cover image filename | `cover.jpg` |
| language | JSON list of languages | `["English", "French"]` |
| screenshot | JSON list of screenshots | `["one.jpg"]` |
| trailer | Trailer URL | `https://...` |
| website | Official website | `https://...` |

### News

| Field | Business Description | Example Value |
|------|----------------------|---------------|
| id | Unique news identifier | `11` |
| author | Optional author user | `User#1` |
| title | Article title | `Silent Hill f brings Japanese horror to the series` |
| slug | Public route identifier | `silent-hill-f-brings-japanese-horror-to-the-series` |
| content | Full article content | HTML or text |
| summary | Short article summary | HTML or text |
| cover | Cover image filename | `cover.jpg` |
| status | Publication status | `Published` |

### Review

| Field | Business Description | Example Value |
|------|----------------------|---------------|
| id | Unique review identifier | `1` |
| author | Optional author user | `User#1` |
| title | Review title | `Cyberpunk 2077 Review` |
| slug | Public route identifier | `cyberpunk-2077-review` |
| content | Full review content | HTML or text |
| summary | Short review summary | HTML or text |
| cover | Cover image filename | `cover.jpg` |
| gameRating | Numeric game rating | `9` |
| status | Publication status | `Published` |

### Comment

| Field | Business Description | Example Value |
|------|----------------------|---------------|
| id | Unique comment identifier | `1` |
| author | Optional author user | `User#1` |
| review | Parent review | `Review#1` |
| content | Comment text | `Great review` |
| status | Moderation status | `Published` |

### Metadata Entities

| Entity | Business Description | Main Fields |
|------|----------------------|-------------|
| Tag | Content label used by news and reviews | `id`, `title`, `slug` |
| Genre | Game genre | `id`, `title`, `slug` |
| Platform | Game platform | `id`, `title`, `slug` |
| Developer | Game developer studio | `id`, `title`, `slug`, `country`, `website` |
| Publisher | Game publisher | `id`, `title`, `slug`, `country`, `website` |

## 2. REST API Endpoints

### Authentication

1. **`POST /api/login`** - Sign in
   * Request body: `email`, `password`
   * Result: creates a `UserToken`, returns `session_id`, and sets the `session_id` cookie

2. **`POST /api/logout`** - Sign out
   * Auth: session cookie when available
   * Result: revokes the current token and clears the cookie

3. **`GET /api/profile`** - Current profile
   * Auth: required
   * Result: current user profile

### Core Content

4. **`GET /api/game`** - Get games
   * Public access
   * Query parameters: `page`, `limit`, `status`, `sort`
   * Default status: `Published`
   * Allowed sort fields: `createdAt`, `updatedAt`

5. **`GET /api/game/{id}`** - Get game by id
   * Public access

6. **`POST /api/game`**, **`PATCH /api/game/{id}`**, **`DELETE /api/game/{id}`**
   * Auth required
   * Used for protected content management through API

7. **`GET /api/news`**, **`GET /api/news/{id}`**
   * Public access
   * Collection supports `page`, `limit`, `status`, and `sort`

8. **`POST /api/news`**, **`PATCH /api/news/{id}`**, **`DELETE /api/news/{id}`**
   * Auth required

9. **`GET /api/review`**, **`GET /api/review/{id}`**
   * Public access
   * Collection supports `page`, `limit`, `status`, and `sort`

10. **`POST /api/review`**, **`PATCH /api/review/{id}`**, **`DELETE /api/review/{id}`**
    * Auth required

11. **`GET /api/comment`**, **`GET /api/comment/{id}`**
    * Collection and item endpoints for comments

12. **`POST /api/comment`**, **`PATCH /api/comment/{id}`**, **`DELETE /api/comment/{id}`**
    * Auth required

### Metadata

13. **`GET /api/tag`**, **`GET /api/tag/{id}`**
14. **`GET /api/genre`**, **`GET /api/genre/{id}`**
15. **`GET /api/platform`**, **`GET /api/platform/{id}`**
16. **`GET /api/developer`**, **`GET /api/developer/{id}`**
17. **`GET /api/publisher`**, **`GET /api/publisher/{id}`**

Metadata create, update, and delete endpoints exist with the same pattern:

```text
POST /api/{entity}
PATCH /api/{entity}/{id}
DELETE /api/{entity}/{id}
```

### Slug Resolution and Latest Content

18. **`GET /api/{entityType}/resolve/{slug}`** - Resolve public slug
    * Public access
    * Used by frontend dynamic routes

19. **`GET /api/latest`** - Latest content
    * Public access

### Admin and Documentation

20. **`ANY /admin`** - EasyAdmin dashboard
21. **`ANY /admin/login`** - Admin login
22. **`GET /api/doc`** - Swagger UI
23. **`GET /api/doc.json`** - OpenAPI JSON
24. **`ANY /stats`** - Stats page

## 3. Business Rules

1. Published content is public.
2. Collection endpoints for games, news, and reviews default to `Published`.
3. Admin-only content states can be requested through status filters where the API allows them.
4. Users authenticate with email and password.
5. Browser session state is stored in a `session_id` cookie.
6. Protected API routes require a valid, non-revoked `UserToken`.
7. Admin back-office access requires `ROLE_ADMIN`.
8. Slugs are used for public frontend routing.
9. Many-to-many relationships are modeled through junction tables.
10. Deleting related records uses database cascade behavior where defined by Doctrine migrations.

## 4. API Response and Validation Notes

1. JSON is the primary API format.
2. Core collection responses include `items` and `pagination`.
3. Invalid sort fields produce an invalid argument error.
4. Login returns `400` for missing credentials and `401` for invalid credentials.
5. Profile returns `401` when the session cookie is missing or invalid.
6. CORS allows credentialed requests from configured frontend origins.

