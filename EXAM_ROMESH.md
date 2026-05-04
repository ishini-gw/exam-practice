# Laravel Exam - Ravindu/Romesh
## Library Management System

**Student Name:** Ravindu/Romesh  
**Duration:** 5 days  
**Total Marks:** 100

---

## Project Overview
Build a Library Management System using Laravel 10+ with user authentication, book management, and category administration.

### System Requirement

---

## Task 1: Project Setup (5 marks)
- [ ] Create a new Laravel project using Composer
- [ ] Setup Laravel Breeze for user authentication
- [ ] Initialize Git repository and create GitHub repo
- [ ] Push initial base code to GitHub
- [ ] Configure `.env` file with database credentials
- [ ] Run migrations for auth system

**Acceptance Criteria:**
- Project must be accessible at `http://localhost:8000`
- Authentication (Login/Register) must be working
- Database must be connected and migrations successful

---

## Task 2: Database Design & Migrations (10 marks)

### Table 1: Categories (Master Table)
Create a `categories` table with the following structure:

```sql
Schema::create('categories', function (Blueprint $table) {
    $table->id();
    $table->string('name')->unique();
    $table->text('description')->nullable();
    $table->string('slug')->unique();
    $table->integer('book_count')->default(0);
    $table->boolean('is_active')->default(true);
    $table->timestamps();
});
```

**Requirements:**
- Create migration file
- Seed at least 8 categories using Seeder (DatabaseSeeder)
- Categories: Fiction, Non-Fiction, Science, History, Business, Self-Help, Children, Biography
- Use Faker for realistic descriptions

### Table 2: Books (Detail Table)
Create a `books` table with the following structure:

```sql
Schema::create('books', function (Blueprint $table) {
    $table->id();
    $table->foreignId('category_id')->constrained()->onDelete('cascade');
    $table->string('title');
    $table->string('author');
    $table->string('isbn')->unique();
    $table->text('description')->nullable();
    $table->date('published_date');
    $table->integer('pages');
    $table->decimal('price', 8, 2);
    $table->integer('available_copies')->default(0);
    $table->integer('total_copies')->default(0);
    $table->string('publisher')->nullable();
    $table->softDeletes();
    $table->foreignId('created_by')->constrained('users')->onDelete('restrict');
    $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('restrict');
    $table->foreignId('deleted_by')->nullable()->constrained('users')->onDelete('restrict');
    $table->timestamps();
});
```

**Requirements:**
- Create migration file
- Setup soft delete functionality
- Add audit fields (created_by, updated_by, deleted_by)
- Link to users table for audit trail

---

## Task 3: Authentication & Authorization (5 marks)
- [ ] Complete user registration and login (via Breeze)
- [ ] Setup middleware to protect routes
- [ ] Create dashboard after login
- [ ] Implement logout functionality
- [ ] Test authentication flow

**Acceptance Criteria:**
- Non-authenticated users cannot access book/category pages
- Users can register and login successfully
- Session properly maintained

---

## Task 4: Models & Relationships (10 marks)

### Category Model
```php
// app/Models/Category.php
class Category extends Model
{
    // Implement relationship to books
    // Implement scopes if needed
}
```

### Book Model
```php
// app/Models/Book.php
class Book extends Model
{
    // Implement soft deletes
    // Implement relationship to category
    // Implement relationship to creator/updater
}
```

**Requirements:**
- Define all relationships correctly
- Implement eager loading to prevent N+1 queries
- Create scopes for filtering (e.g., `available()`, `byCategory($id)`, `expensiveBooks()`)
- Implement `created_by` relationship

---

## Task 5: CRUD Operations for Books (40 marks)

### 5.1 Create Book (8 marks)
- [ ] Create `/books/create` form with validation
- [ ] Form must include: title, author, isbn, description, published_date, pages, price, available_copies, total_copies, publisher, category_id
- [ ] Validate ISBN uniqueness
- [ ] Validate year not in future
- [ ] Validate pages and copies as integers
- [ ] Set `created_by` automatically to logged-in user
- [ ] Redirect to list on success

**Validation Rules:**
```
title: required, string, max:255
author: required, string, max:255
isbn: required, string, unique, regex:/^\d{10}(\d{3})?$/
description: nullable, string
published_date: required, date, before_or_equal:today
pages: required, integer, min:1
price: required, numeric, min:0
available_copies: required, integer, min:0
total_copies: required, integer, min:0
publisher: nullable, string, max:255
category_id: required, exists:categories,id
```

### 5.2 List Books (12 marks)
- [ ] Display all books in a table format
- [ ] Show columns: ID, Title, Author, ISBN, Category, Price, Available Copies, Total Copies, Publisher, Actions
- [ ] Implement pagination (20 per page)
- [ ] Show soft-deleted books separately with restore/force-delete options
- [ ] Add action buttons: View, Edit, Delete
- [ ] Display creator information (created_by user name)
- [ ] Color code availability status (Green: Available, Red: Out of Stock)

### 5.3 Search Functionality (8 marks)
- [ ] Search by book title
- [ ] Search by author name
- [ ] Search by ISBN
- [ ] Search by category
- [ ] Filter by availability status (Available, Out of Stock)
- [ ] Search form on list page
- [ ] Maintain search filters during pagination
- [ ] Case-insensitive search

**Example URL:** `GET /books?search=harry&author=rowling&category=1&availability=available`

### 5.4 Show Book (6 marks)
- [ ] Display complete book details including jacket/cover
- [ ] Show category information with link to category books
- [ ] Display audit trail (created_by user, created_at timestamp)
- [ ] Show updated_by information if available
- [ ] Show availability status
- [ ] Add back link to book list

### 5.5 Edit Book (6 marks)
- [ ] Pre-populate form with book data
- [ ] Allow updating all fields except ISBN (optional: allow reassignment)
- [ ] Update `updated_by` to logged-in user
- [ ] Validate same rules as create
- [ ] Redirect to list on success
- [ ] Show success message
- [ ] Prevent editing if book is deleted

---

## Task 6: Audit Fields Implementation (10 marks)

### Requirements:
- [ ] Automatically set `created_by` when book is created
- [ ] Automatically set `updated_by` when book is updated
- [ ] Automatically set `deleted_by` when book is soft-deleted
- [ ] Store current authenticated user ID in these fields
- [ ] Display audit information in list and show views
- [ ] Create controller method to show audit log for each book

**Example Audit Display:**
```
Created by: John Doe (2024-02-01 10:30)
Updated by: Jane Smith (2024-02-15 14:20)
Last modified 14 days ago
```

---

## Task 7: Soft Delete Implementation (10 marks)

### Requirements:
- [ ] Books are soft-deleted, not permanently removed
- [ ] Soft-deleted books don't appear in normal list
- [ ] Create separate view/section to show deleted books
- [ ] Implement restore functionality
- [ ] Implement permanent delete (force delete) functionality
- [ ] Add filter toggle in list "Show All / Active Only / Deleted Only"
- [ ] Test recovery of deleted book
- [ ] Maintain referential integrity

---

## Task 8: Bonus Features (20 marks) - Optional

### Option A1: Advanced Scopes (7 marks)
```php
// Implement scopes in Book model
$books->available(); // Books with available_copies > 0
$books->byCategory($id); // Filter by category
$books->expensiveBooks($price); // Books more expensive than price
$books->recentlyAdded($days); // Added in last N days
$books->byAuthor($name); // Filter by author
```

### Option A2: Library Dashboard (7 marks)
- [ ] Dashboard showing total books
- [ ] Dashboard showing books by category
- [ ] Dashboard showing out-of-stock books
- [ ] Dashboard showing total value of library
- [ ] Recently added books section
- [ ] Category distribution chart/graph

### Option A3: Inventory Management (6 marks)
- [ ] Track book copies (available vs total)
- [ ] Low stock alerts
- [ ] Generate inventory report
- [ ] Update available copies on book edit
- [ ] Show inventory status

### Option B: Book Ratings & Reviews (7 marks)
- [ ] Create reviews table linked to books
- [ ] Implement one-to-many relationship
- [ ] Display average rating in book details
- [ ] Show all reviews in detail view
- [ ] Add rating scope for top-rated books

### Option C: Export Functionality (7 marks)
- [ ] Export book list to CSV
- [ ] Export books to PDF catalog
- [ ] Include category and author in export
- [ ] Include audit information in export
- [ ] Generate inventory report

---

## Grading Rubric

| Task | Max Marks | Criteria |
|------|-----------|----------|
| Project Setup | 5 | Git setup, Laravel config, Authentication |
| Database & Migrations | 10 | Table structure, relationships, seeder |
| Authentication | 5 | Breeze setup, middleware, authorization |
| Models & Relationships | 10 | Model definition, relationships, scopes |
| Create Book | 8 | Form validation, audit fields, UX |
| List Books | 12 | Pagination, display, soft delete handling, status |
| Search Functionality | 8 | Multiple fields, filters, pagination, UX |
| Show Book | 6 | Detail view, audit info, navigation |
| Edit Book | 6 | Form pre-population, validation, audit |
| Audit Fields | 10 | Automatic tracking, display, trail |
| Soft Delete | 10 | Hidden records, restore, force delete |
| **Subtotal** | **90** | |
| **Bonus Features** | **+20** | Choose at least 2 options |
| **TOTAL** | **100+** | |

---

## Code Quality (Deducted from marks if not met)

| Issue | Deduction |
|-------|-----------|
| Missing comments/documentation | -5 |
| Inconsistent naming conventions | -5 |
| N+1 query problems | -10 |
| No pagination | -5 |
| XSS vulnerabilities | -15 |
| SQL injection risks | -15 |

---

## Submission Checklist

- [ ] GitHub repository created and shared
- [ ] All required files committed
- [ ] `.env.example` file present (without sensitive data)
- [ ] Database migrations working
- [ ] Seeders working (especially categories seeder)
- [ ] All features working as specified
- [ ] No broken links or 404 errors
- [ ] Application runs without errors
- [ ] README.md with setup instructions included

---

## Setup Instructions (For Evaluator)

```bash
# Clone repository
git clone <repo-url>
cd <project-folder>

# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate app key
php artisan key:generate

# Setup database
php artisan migrate:fresh --seed

# Start server
php artisan serve

# Access: http://localhost:8000
```

---

## Important Notes

1. **Code Quality:** Clean, readable code with proper comments
2. **Git Commits:** Regular commits with meaningful messages
3. **Testing:** Manually test all features thoroughly
4. **Error Handling:** Implement proper error handling and validation
5. **Security:** Use Laravel's built-in security features (CSRF protection, input validation)
6. **Database:** Ensure all migrations are reversible
7. **Master Data:** Categories must be pre-seeded and not have CRUD forms

---

## Bonus Points Summary

- **Scopes Implementation:** +3 marks
- **Advanced Relationships:** +4 marks
- **Dashboard/Statistics:** +5 marks
- **Inventory Management:** +4 marks
- **Export to PDF/CSV:** +4 marks

**Maximum Possible Marks: 120**

---

**Deadline:** Submit GitHub link within exam duration  
**Evaluation Date:** [To be decided]
