📘 README.md
markdown
# NaviFleet — Modern Fleet Management System

NaviFleet is a modern, modular fleet‑management platform built with **Laravel 13**, **Livewire 4**, and **TailwindCSS**.  
It provides complete tooling for managing vehicles, drivers, assignments, maintenance, costs, alerts, and operational data.

This project is designed as a real‑world, production‑ready system suitable for taxi companies, transport fleets, logistics teams, and internal corporate vehicle management.

---

## 🚀 Features

### Fleet Management
- Vehicle registry (brand, model, VIN, registration, mileage, status)
- Vehicle types (taxi, van, bus, EV, etc.)
- Full vehicle history (assignments, maintenance, costs)
- Status tracking (available, assigned, in service, retired)

### Driver Management
- Driver profiles + employment data  
- User ↔ Employee linking  
- Licenses & documents (expiry tracking)
- Driver assignments & history

### Operations
- Maintenance & service records  
- Fuel logs  
- Expenses (insurance, repairs, tolls, misc.)
- File attachments (invoices, documents)

### Assignments
- Driver ↔ Vehicle assignment timeline  
- Active & historical records  
- Automatic conflict prevention

### Alerts & Notifications
- Expiring documents  
- Upcoming inspections  
- Mileage‑based service reminders  
- Optional email notifications

### Dashboard
- Fleet availability  
- Monthly cost overview  
- Upcoming deadlines  
- Vehicle utilization  
- Charts (ApexCharts / Chart.js)

### Tech Stack
- **Laravel 13**
- **Livewire 4**
- **TailwindCSS**
- **SQLite / MySQL / PostgreSQL**
- **Redis (queues, cache)**
- **Pest (testing)**

---

## 📂 Project Structure

app/
Domain/
Fleet/
Drivers/
Maintenance/
Expenses/
Assignments/
Http/
Controllers/
Requests/
Resources/
Models/

resources/
views/
layouts/
components/
employees/
vehicles/
livewire/
partials/

database/
migrations/
seeders/
database.sqlite

Kod

---

## 🛠 Installation

### Requirements
- PHP 8.4+
- Composer 2.x
- Node.js LTS
- Laravel Herd (recommended)
- SQLite / MySQL / PostgreSQL
- Redis (optional but recommended)

### Steps

```bash
composer install
npm install
npm run build
php artisan key:generate
php artisan migrate
Start the local server:

bash
herd open
Or:

bash
php artisan serve
Visit:

Kod
http://navifleet.test
🧪 Testing
bash
php artisan test
Or with Pest:

bash
./vendor/bin/pest
📜 License
MIT License
Copyright © 2026

Kod

---

# 📘 ARCHITECTURE.md

```markdown
# NaviFleet — Architecture Overview

NaviFleet follows a modular, domain‑driven structure inspired by modern Laravel practices.

---

## 🧱 Domain Modules

### Fleet
- Vehicle model
- VehicleType model
- VehicleStatus enum
- Vehicle history aggregation

### Drivers
- Driver model
- DriverDocument model
- License expiry logic
- User ↔ Employee linking

### Assignments
- VehicleAssignment model
- Conflict detection
- Timeline rendering

### Maintenance
- Maintenance model
- Service categories
- Mileage‑based reminders

### Expenses
- Expense model (polymorphic)
- FuelLog model
- Invoice attachments

---

## 🧩 Livewire Components

- `Vehicles/Index`
- `Vehicles/Create`
- `Employees/Show`
- `Employees/Edit`
- `Assignments/Manage`
- `Dashboard/Overview`

---

## 🗄 Database

SQLite (development)  
MySQL/PostgreSQL (production)

Tables include:

- users  
- employees  
- vehicles  
- vehicle_assignments  
- maintenances  
- expenses  
- driver_documents  
- fuel_logs  
- sessions  
- cache  
- jobs  

---

## 🔔 Event System

- `VehicleStatusChanged`
- `DocumentExpiring`
- `MaintenanceCompleted`

Listeners:
- Send notifications
- Log activity
- Trigger alerts

---

## 📦 Queues

Redis + Horizon recommended.

Used for:
- Email alerts
- Document expiry checks
- Maintenance reminders

---

## 🔐 Security

- Laravel Sanctum (API tokens)
- spatie/laravel-permission (roles)
- CSRF protection
- Session encryption
📘 DATABASE.md
markdown
# NaviFleet — Database Schema

---

## Users

| Column | Type |
|--------|------|
| id | integer |
| first_name | varchar |
| last_name | varchar |
| email | varchar |
| role | varchar |
| password | varchar |
| email_verified_at | datetime |
| created_at | datetime |
| updated_at | datetime |

---

## Employees

| Column | Type |
|--------|------|
| id | integer |
| user_id | integer |
| role | varchar |
| department | varchar |
| status | enum |
| created_at | datetime |
| updated_at | datetime |

---

## Vehicles

| Column | Type |
|--------|------|
| id | integer |
| brand | varchar |
| model | varchar |
| registration_number | varchar |
| vin | varchar |
| mileage | integer |
| status | enum |
| purchase_date | date |
| created_at | datetime |
| updated_at | datetime |

---

## Vehicle Assignments

| Column | Type |
|--------|------|
| id | integer |
| vehicle_id | integer |
| driver_id | integer |
| assigned_from | date |
| assigned_to | date |
| created_at | datetime |

---

## Maintenances

| Column | Type |
|--------|------|
| id | integer |
| vehicle_id | integer |
| type | varchar |
| mileage | integer |
| cost | decimal |
| workshop | varchar |
| description | text |
| created_at | datetime |

---

## Expenses

| Column | Type |
|--------|------|
| id | integer |
| vehicle_id | integer |
| category | varchar |
| amount | decimal |
| date | date |
| description | text |
| created_at | datetime |
📘 API.md
markdown
# NaviFleet — REST API Documentation

Authentication: **Laravel Sanctum**

---

## Vehicles

### GET /api/vehicles
Returns paginated list of vehicles.

### POST /api/vehicles
Creates a new vehicle.

### GET /api/vehicles/{id}
Returns vehicle details + history.

### PUT /api/vehicles/{id}
Updates vehicle.

### DELETE /api/vehicles/{id}
Soft‑deletes vehicle.

---

## Drivers

### GET /api/drivers
List drivers.

### POST /api/drivers
Create driver.

---

## Assignments

### POST /api/assignments
Assign driver to vehicle.

### GET /api/assignments/{vehicle_id}
Get assignment history.

---

## Maintenance

### POST /api/maintenance
Add maintenance record.

---

## Expenses

### POST /api/expenses
Add expense.

---

## Authentication

### POST /api/login
Returns token.

### POST /api/logout
Revokes token.
📘 CONTRIBUTING.md
markdown
# Contributing Guidelines

## Branching Strategy
- `main` — stable production
- `develop` — active development
- `feature/*` — new features
- `fix/*` — bug fixes

## Commit Convention (Conventional Commits)
- `feat:` new feature
- `fix:` bug fix
- `docs:` documentation
- `refactor:` code cleanup
- `test:` tests

## Pull Requests
- Must include tests
- Must pass Pint + PHPStan
- Must be reviewed by at least one contributor

## Code Style
- Laravel Pint
- PSR‑12
📘 INSTALLATION.md
markdown
# Installation Guide

## Requirements
- PHP 8.4+
- Composer 2.x
- Node.js LTS
- Laravel Herd (recommended)
- SQLite / MySQL / PostgreSQL
- Redis (optional)

## Steps
composer install
npm install
npm run build
php artisan key:generate
php artisan migrate
herd open
📘 ROADMAP.md
markdown
# NaviFleet Roadmap

## Phase 1 — Core
- Vehicles
- Drivers
- Assignments
- Basic dashboard

## Phase 2 — Operations
- Maintenance module
- Expenses module
- Fuel logs
- Alerts

## Phase 3 — Advanced
- API (Sanctum)
- Driver mobile panel
- Reports + exports
- Redis queues

## Phase 4 — Polish
- Full test coverage
- Docker deployment
- AI insights
