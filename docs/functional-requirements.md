# Functional Requirements

## 1. Public Content Browsing

### 1.1. Browse Games

* **Requirement source:** Public users.
* **Requirement description:** Provide a game catalog with pagination, sorting, and status filtering for published and administrative content states.
* **Requirement priority:** High.

### 1.2. View Game Details

* **Requirement source:** Public users.
* **Requirement description:** Show a game detail page with title, summary, content, cover, release data, age rating, platforms, genres, developers, publishers, related news, and related reviews.
* **Requirement priority:** High.

### 1.3. Browse News

* **Requirement source:** Public users.
* **Requirement description:** Provide a news listing with pagination, sorting, and status filtering.
* **Requirement priority:** High.

### 1.4. View News Details

* **Requirement source:** Public users.
* **Requirement description:** Show a news article with author, tags, related games, cover, summary, and full content.
* **Requirement priority:** High.

### 1.5. Browse Reviews

* **Requirement source:** Public users.
* **Requirement description:** Provide a review listing with pagination, sorting, and status filtering.
* **Requirement priority:** High.

### 1.6. View Review Details

* **Requirement source:** Public users.
* **Requirement description:** Show a review with author, rating, tags, related games, comments, cover, summary, and full content.
* **Requirement priority:** High.

## 2. Metadata Browsing

### 2.1. Browse Metadata Collections

* **Requirement source:** Public users.
* **Requirement description:** Provide collection pages for developers, publishers, genres, platforms, and tags.
* **Requirement priority:** Medium.

### 2.2. View Metadata Details

* **Requirement source:** Public users.
* **Requirement description:** Provide detail pages for metadata entities and related content where available.
* **Requirement priority:** Medium.

### 2.3. Resolve Slugs

* **Requirement source:** Frontend application.
* **Requirement description:** Resolve public entity pages by slug through `/api/{entityType}/resolve/{slug}`.
* **Requirement priority:** High.

## 3. Authentication and Profile

### 3.1. Sign In

* **Requirement source:** Registered users and administrators.
* **Requirement description:** Authenticate users by email and password using `POST /api/login`.
* **Requirement priority:** High.

### 3.2. Session Cookie

* **Requirement source:** Authenticated users.
* **Requirement description:** Store authentication state in an HttpOnly `session_id` cookie backed by `UserToken`.
* **Requirement priority:** High.

### 3.3. Sign Out

* **Requirement source:** Authenticated users.
* **Requirement description:** Revoke the current session token and clear the cookie through `POST /api/logout`.
* **Requirement priority:** High.

### 3.4. View Profile

* **Requirement source:** Authenticated users.
* **Requirement description:** Show the authenticated user's email, nickname, roles, avatar, Twitch account, and timestamps.
* **Requirement priority:** Medium.

## 4. Administration

### 4.1. Admin Login

* **Requirement source:** Administrators.
* **Requirement description:** Provide an EasyAdmin login flow at `/admin/login`.
* **Requirement priority:** High.

### 4.2. Manage Core Content

* **Requirement source:** Administrators.
* **Requirement description:** Provide CRUD workflows for games, news, reviews, and comments.
* **Requirement priority:** High.

### 4.3. Manage Metadata

* **Requirement source:** Administrators.
* **Requirement description:** Provide CRUD workflows for tags, genres, platforms, developers, and publishers.
* **Requirement priority:** High.

### 4.4. Manage Users

* **Requirement source:** Administrators.
* **Requirement description:** Provide CRUD workflows for user accounts, including password hashing when passwords are created or changed.
* **Requirement priority:** High.

## 5. API and Integration

### 5.1. REST API

* **Requirement source:** Frontend and external clients.
* **Requirement description:** Provide JSON API endpoints for authentication, profile, content entities, metadata entities, latest content, and slug resolution.
* **Requirement priority:** High.

### 5.2. Swagger Documentation

* **Requirement source:** Developers and evaluators.
* **Requirement description:** Expose API documentation through NelmioApiDocBundle at `/api/doc`.
* **Requirement priority:** Medium.

### 5.3. CORS Configuration

* **Requirement source:** Frontend application.
* **Requirement description:** Allow local and deployment frontend origins to call the backend with credentials.
* **Requirement priority:** High.

## 6. Deployment and Local Development

### 6.1. Docker Compose Stack

* **Requirement source:** Developers and evaluators.
* **Requirement description:** Provide a Docker Compose setup for frontend, backend, MySQL, and phpMyAdmin.
* **Requirement priority:** High.

### 6.2. Local Overrides

* **Requirement source:** Developers.
* **Requirement description:** Provide local override configuration for localhost URLs, CORS, and Windows line ending compatibility.
* **Requirement priority:** High.

