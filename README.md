# Job Portal Web Application

A full-featured job portal platform built with Laravel that connects job seekers and employers seamlessly.

## Features

- **For Job Seekers:**
  - Browse and search jobs by category, location, or keywords
  - Create and manage profile with resume upload
  - Apply to jobs with one click
  - Track application status

- **For Recruiters/Employers:**
  - Post and manage job listings
  - Review applications and manage candidates
  - Shortlist or reject applicants
  - Communicate with job seekers

- **Admin Panel:**
  - Manage users, jobs, and categories
  - Approve/decline job postings
  - Site-wide settings

## Tech Stack

- **Framework:** Laravel
- **Database:** MySQL
- **Frontend:** Blade, Bootstrap
- **Authentication:** Laravel Breeze/Jetstream
- **Storage:** Laravel Filesystem (for resumes/photos)

## Installation

```bash
git clone https://github.com/yourusername/job-portal.git
cd job-portal
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve