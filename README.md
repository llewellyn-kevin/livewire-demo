# Outreach Laravel Practical Test

## Practical Exam Instructions
Please build a note taking app. A user should be able to sign in to an account and do the following:
1) View their notes.
2) Add a new note.
3) Edit an existing note.
4) Delete a note.

It's expected that a user will not have access to another user's notes in any capacity.

This repository is meant to be a starting place for you to show off your frontend and backend development skills. We've preinstalled and configured a modern Laravel (TALL) stack including:
- Laravel 8
- Laravel Jetstream (Livewire)
- AlpineJS
- TailwindCSS (Tailwind UI)
- Blade UI Kit.

No JS/CSS build steps are required, because some environments may not allow it. As a result, built CSS and JS files have been commented out, but may be added back in if necessary.

You're welcome to use another CSS/JS framework, and add additional packages, but it's not necessary to complete this exercise.

Please follow the setup instructions outlined below to get started.

We look forward to seeing what you can build. Cheers! 🎉

### Setup Instructions
1) `touch database/database.sqlite`
2) `cp .env.example .env`
3) `composer install`
4) `php artisan key:generate`
5) `php artisan migrate`

