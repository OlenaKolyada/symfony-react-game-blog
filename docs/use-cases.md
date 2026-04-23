# Grem Use Cases

## PublicContentFeature

### Use case: Browse games

**Goal:**  
Allow a visitor to explore the game catalog.

**Flow:**  
1. Visitor opens the games page.
2. Frontend requests `/api/game`.
3. Backend returns paginated games filtered by status and sorted by date.
4. Frontend renders game cards.

**Result:**  
Visitor sees the game catalog.

---

### Use case: View game details

**Goal:**  
Show full information about a selected game.

**Flow:**  
1. Visitor selects a game slug.
2. Frontend resolves the slug through `/api/game/resolve/{slug}` or requests the game data.
3. Backend returns game data and relationships.
4. Frontend renders the game detail page.

**Result:**  
Visitor sees game content and related metadata.

---

### Use case: Browse news

**Goal:**  
Allow a visitor to read gaming news.

**Flow:**  
1. Visitor opens the news page.
2. Frontend requests `/api/news`.
3. Backend returns paginated news.
4. Frontend renders news cards.

**Result:**  
Visitor sees the news list.

---

### Use case: View news article

**Goal:**  
Show full news content.

**Flow:**  
1. Visitor opens a news slug.
2. Frontend resolves the slug and requests article data.
3. Backend returns title, summary, content, author, tags, games, and cover.
4. Frontend renders the article page.

**Result:**  
Visitor reads the selected news article.

---

### Use case: Browse reviews

**Goal:**  
Allow a visitor to explore reviews.

**Flow:**  
1. Visitor opens the reviews page.
2. Frontend requests `/api/review`.
3. Backend returns paginated reviews.
4. Frontend renders review cards.

**Result:**  
Visitor sees the review list.

---

### Use case: View review details

**Goal:**  
Show full review content and rating.

**Flow:**  
1. Visitor opens a review slug.
2. Frontend resolves the slug and requests review data.
3. Backend returns review data, rating, tags, related games, and comments.
4. Frontend renders the review detail page.

**Result:**  
Visitor reads the selected review.

---

## MetadataFeature

### Use case: Browse metadata pages

**Goal:**  
Allow visitors to browse tags, genres, platforms, developers, and publishers.

**Flow:**  
1. Visitor opens a metadata collection page.
2. Frontend requests the matching API collection endpoint.
3. Backend returns the metadata records.
4. Frontend renders the list.

**Result:**  
Visitor can discover content dimensions used by the portal.

---

### Use case: Resolve page by slug

**Goal:**  
Support readable URLs in the frontend.

**Flow:**  
1. Visitor opens a URL containing a slug.
2. Frontend calls `/api/{entityType}/resolve/{slug}`.
3. Backend finds the matching entity.
4. Frontend renders the detail page or handles a missing entity.

**Result:**  
Slug-based routes work for public pages.

---

## AuthFeature

### Use case: Sign in

**Goal:**  
Allow a registered user to access authenticated functionality.

**Flow:**  
1. User enters email and password.
2. Frontend posts credentials to `/api/login`.
3. Backend validates the password.
4. Backend creates a `UserToken`.
5. Backend sets the `session_id` cookie.
6. Frontend requests `/api/profile`.

**Result:**  
User is authenticated and profile data is loaded.

---

### Use case: View profile

**Goal:**  
Show the current authenticated user.

**Flow:**  
1. User opens the profile page.
2. Frontend requests `/api/profile` with cookies.
3. `TokenAuthenticator` validates the `session_id`.
4. Backend returns profile data.
5. Frontend renders the profile page.

**Result:**  
User sees their profile.

---

### Use case: Sign out

**Goal:**  
End the current authenticated session.

**Flow:**  
1. User clicks `Sign Out`.
2. Frontend posts to `/api/logout`.
3. Backend revokes the current `UserToken`.
4. Backend clears the session cookie.
5. Frontend returns the user to the login state.

**Result:**  
User is signed out.

---

## AdminFeature

### Use case: Open admin dashboard

**Goal:**  
Allow administrators to manage content.

**Flow:**  
1. Administrator opens `/admin`.
2. Symfony security redirects unauthenticated administrators to `/admin/login`.
3. Administrator signs in.
4. EasyAdmin opens the dashboard.

**Result:**  
Administrator can access back-office sections.

---

### Use case: Create or update content

**Goal:**  
Allow administrators to maintain portal content.

**Flow:**  
1. Administrator opens an EasyAdmin CRUD section.
2. Administrator fills or edits entity fields.
3. Backend validates and persists the entity through Doctrine.
4. Content becomes available through API endpoints according to its status.

**Result:**  
Content is created or updated.

---

### Use case: Manage users

**Goal:**  
Allow administrators to maintain user accounts.

**Flow:**  
1. Administrator opens the user CRUD section.
2. Administrator creates or updates user data.
3. If a password is provided, it is hashed before persistence.
4. Backend saves the user.

**Result:**  
User data is maintained safely.

