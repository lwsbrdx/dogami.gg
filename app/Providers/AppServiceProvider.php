<?php

namespace App\Providers;

use Exception;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if($this->app->environment('production') || $this->app->environment('distant')) {
            URL::forceScheme('https');
        }

        Blade::directive('formatclasses', function ($expression) {
            if (is_string($expression)) {
                return "<?php echo preg_replace('/\n+/', '', trim(preg_replace('/\s+/', ' ', $expression))) ?>";
            }

            throw new Exception("Directive's expression should be a string");
        });
    }
}
