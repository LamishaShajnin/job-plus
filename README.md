# Job Plus - Job Seeker & Recruiter Platform

A full-featured job portal platform built with Laravel that connects job seekers and employers seamlessly.

## Features

### For Job Seekers
- Browse and search jobs by category, location, or keywords
- Create and manage professional profile with resume upload
- Apply to jobs with one click
- Track application status in real-time
- Save favorite jobs for later
- View application history

### For Employers/Recruiters
- Post and manage job listings
- Review incoming applications
- Shortlist or reject applicants
- Manage company profile
- View applicant analytics and statistics
- Communicate with job seekers

### For Admins
- Approve/reject job postings
- Manage all users (job seekers & employers)
- Manage job categories
- Generate reports and analytics
- Site-wide settings management

## Tech Stack

- **Backend**: Laravel 11.x (PHP 8.2+)
- **Database**: MySQL
- **Frontend**: Blade Templates, Bootstrap 5.3
- **Authentication**: Laravel Breeze/Jetstream
- **Storage**: Laravel Filesystem (for resumes & company logos)
- **Email**: Laravel Mail (SMTP)
- **Security**: CSRF protection, prepared statements, role-based middleware

## Installation

### 1. Prerequisites

Make sure you have installed:
- PHP >= 8.2
- Composer
- MySQL
- XAMPP

### 2. Clone the Repository

```bash
git clone https://github.com/yourusername/job-portal.git
cd job-portal


