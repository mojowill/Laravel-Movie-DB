# Example Movie App

A simple app to display information from the [TMDB](https://www.themoviedb.org/).
Built following along with Andre Madarangs course on [YouTube](https://www.youtube.com/watch?v=9OKbmMqsREc). You can grab the original code from [GitHub](https://github.com/drehimself/laravel-movies-example).

You will need an API from the TMDB, you can get one for free from their [developer section](https://www.themoviedb.org/settings/api).

## Install

* Set `TMDB_TOKEN=` in your `.env` to match your TMDB API token.
* Ensure you have Redis available!
* `composer install` to install PHP dependencies.
* `npm install` to install Node dependencies.
* You can build assets (CSS and JS) with Laravel Mix `npm run dev` or `npm run prod`.

### Uses:

* Laravel 8
* TailwindCSS
* Livewire
* AlpineJS

### Note
I made some changes along the way to fully use blade components in Laravel 8 and also made use of Redis to cache the API results.
