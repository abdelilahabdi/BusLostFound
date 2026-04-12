# BusLost&Found - Project Agent Guide

## 1) Project Overview
- **Project**: BusLost&Found (beginner-friendly Laravel 11 graduation project)
- **Goal**: Help bus passengers publish and find lost/found objects safely.
- **Main roles**:
  - Guest: browse and search public announcements
  - User: register/login, create/manage own announcements, update profile, contact other users securely
  - Admin: moderate announcements, manage users, handle reports, view basic stats

## 2) Technical Stack
- Laravel 11
- PHP 8.2+
- Blade templates
- HTML + Tailwind CSS
- Vanilla JavaScript only when needed
- MySQL (SQLite may be used locally for quick setup, but features target MySQL)

## 3) Current Repository Baseline (Analyzed)
- Standard Laravel 11 skeleton structure is present:
  - `app/Http/Controllers/Controller.php` (base controller)
  - `app/Models/User.php`
  - `routes/web.php` with default welcome route
  - `resources/views/welcome.blade.php`
  - default migrations/factory/seeder/test files
- No custom business modules have been implemented yet.

## 4) Coding Style (Beginner-Friendly)
- Keep code simple, explicit, and easy to read.
- Use clear English names (`LostItem`, `FoundItem`, `AnnouncementController`, etc.).
- Prefer small controller methods and straightforward flow.
- Avoid advanced patterns unless clearly needed.
- Add short comments only for non-obvious logic.
- Follow Laravel conventions first, custom structure second.

## 5) Folder Structure Expectations
- Use classic Laravel MVC and keep features organized by responsibility.
- Recommended structure as project grows:
  - `app/Http/Controllers/`
    - `AnnouncementController.php`
    - `ProfileController.php`
    - `Admin/AnnouncementModerationController.php`
    - `Admin/UserManagementController.php`
  - `app/Http/Requests/` for form validation classes
  - `app/Models/` for Eloquent models and relationships
  - `app/Policies/` for ownership/admin authorization
  - `resources/views/`
    - `layouts/`
    - `announcements/`
    - `profile/`
    - `admin/`
    - `partials/`
  - `routes/web.php` for web routes (split only when file becomes too large)

## 6) MVC Rules

### Controllers
- One clear responsibility per controller.
- Use `FormRequest` classes for validation when forms are non-trivial.
- Keep business logic lightweight; move reusable logic to model scopes or small service classes only if needed.
- Always enforce authorization for edit/update/delete/moderation actions.
- Use route model binding and named routes.

### Models
- Define `$fillable` (or guarded strategy) to prevent mass-assignment issues.
- Define relationships (`belongsTo`, `hasMany`, etc.) explicitly.
- Use casts for dates/status fields.
- Use query scopes for reusable filters (status, date, bus line, location).

### Routes
- Use route groups by middleware (`auth`, `verified`, `admin` custom middleware).
- Use route names consistently (`announcements.index`, `admin.users.index`, etc.).
- Keep route files readable; avoid huge anonymous closure routes.

### Blade Views
- Keep Blade mostly presentational; avoid heavy business logic in templates.
- Use shared layout + partials/components for repeated UI blocks.
- Always show validation errors and success/error flash messages.
- Use `@csrf` for all forms and `@method('PUT'|'PATCH'|'DELETE')` where needed.
- Escape output by default (`{{ }}`), use raw output only when strictly necessary and safe.

## 7) UI Rules (Tailwind)
- Keep UI clean and consistent, mobile-first.
- Reuse spacing, typography, and button/input styles across pages.
- Prefer readable forms and tables over fancy effects.
- Use semantic HTML (`label`, `input`, `button`, `nav`, `main`, etc.) and accessible states.
- Keep JavaScript minimal and framework-free unless there is a real need.

## 8) Security Rules
- Never trust request input; validate all user-submitted fields.
- Enforce authentication + authorization on protected actions.
- Protect forms with CSRF tokens (Laravel default).
- Prevent IDOR by checking ownership/policies before showing or changing records.
- Validate uploads (type, size) and store with Laravel storage APIs.
- Do not expose sensitive user data publicly (email/phone should be controlled).
- Throttle abuse-prone routes (contact/report/login-related endpoints as needed).

## 9) Forbidden Packages and Patterns
- Do **not** use admin/CRUD generator packages:
  - Filament
  - Voyager
  - Nova
  - Backpack
  - Any similar package that auto-generates admin panels/CRUD
- Do **not** use React, Vue, Livewire, Inertia, or Alpine-heavy patterns.
- Do **not** introduce unnecessary enterprise architecture (DDD-heavy layers, repository overuse, event overengineering) for basic features.

## 10) Feature Implementation Workflow (Step-by-Step)
1. Define feature scope and acceptance criteria in simple terms.
2. Create/update migration and model fields.
3. Add/adjust model relationships and scopes.
4. Add routes with proper middleware and names.
5. Build controller actions with validation + authorization.
6. Build Blade views (index/show/create/edit as needed) using shared layout.
7. Add feedback states (success/errors/empty states) and basic UX polish.
8. Add tests (feature tests preferred) or at minimum a clear manual test checklist.
9. Run migrations/tests and verify no unrelated files were changed.

## 11) Definition of Done (Per Task)
A task is done only when:
- The feature works end-to-end in browser for expected user role(s).
- Validation, authorization, and error handling are implemented.
- UI is consistent with existing Tailwind patterns and responsive on mobile/desktop.
- Route names, controller actions, and view files follow naming conventions.
- No forbidden package/pattern was introduced.
- Database changes are reversible (migration up/down works).
- At least one test or clear manual verification steps are provided.
- No debug leftovers (`dd`, `dump`, commented dead code) remain.
