# JobPlus - Job Seeker & Employer Platform

A full-featured job portal built with Laravel that seamlessly connects job seekers with employers. The platform provides role-based dashboards for Job Seekers, Employers, and Administrators, enabling job searching, application management, job posting, and full system control.

## Project Overview

**Project Name:** JobPlus  
**Platform Type:** Web-based Job Portal  
**Objective:** To develop a full-featured platform where users can register, log in, search for jobs using multiple criteria, and post jobs if they have a business. The admin manages the entire system, including user profiles and job postings.

## Core Features

### For Job Seekers
- Browse and search jobs by keywords, location, and category.
- View detailed job descriptions.
- Apply for jobs with a single click.
- Save favorite jobs to apply later.
- Track all applied jobs and their status.
- Manage profile, upload a profile picture, and change password.

### For Employers
- Post new job listings with detailed descriptions.
- Manage own job posts (Edit, Delete, View).
- View number of applicants per job post.
- Manage company representative profile.

### For Administrators
- View, edit, and delete all registered users.
- View, edit, delete, approve, or reject all job postings.
- Maintain platform integrity and manage inappropriate content.

## Technical Stack

| Component       | Technology                                    |
|----------------|-----------------------------------------------|
| Backend        | Laravel 12, PHP 8.2+                          |
| Database       | MySQL                                         |
| Frontend       | Blade Templates, Bootstrap 5, Tailwind CSS    |
| Build Tool     | Vite                                          |
| Authentication | Laravel built-in Auth (Breeze/Jetstream style)|
| Security       | CSRF, Middleware, Prepared Statements         |

## System Pages & Access Rights

| Page Name                | Guest | Job Seeker | Employer | Admin |
|--------------------------|-------|------------|----------|-------|
| Home Page                | ✓     | ✓          | ✓        | ✓     |
| Login Page               | ✓     | ✗          | ✗        | ✗     |
| Register Page            | ✓     | ✗          | ✗        | ✗     |
| Job Listing Page         | ✓     | ✓          | ✓        | ✓     |
| Job Detail Page          | ✓     | ✓          | ✓        | ✓     |
| Post a Job Page          | ✗     | ✗          | ✓        | ✓     |
| My Jobs Page             | ✗     | ✗          | ✓        | ✓     |
| Jobs Applied Page        | ✗     | ✓          | ✗        | ✓     |
| Saved Jobs Page          | ✗     | ✓          | ✗        | ✓     |
| Account Settings Page    | ✗     | ✓          | ✓        | ✓     |
| Admin Users Management   | ✗     | ✗          | ✗        | ✓     |
| Admin Jobs Management    | ✗     | ✗          | ✗        | ✓     |

## Prerequisites

Make sure you have the following installed on your local system:

- **PHP** >= 8.2
- **Composer** (Dependency manager for PHP)
- **MySQL** (Database server)
- **XAMPP / WAMP / Laragon** (Local web server environment)
- **Node.js & NPM** (for compiling frontend assets)

## Installation Guide (For Localhost)

Follow these steps to run the project on your local machine.

### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/jobplus.git
cd jobplus