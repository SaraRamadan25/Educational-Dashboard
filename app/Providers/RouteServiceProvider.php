<?php

namespace App\Providers;

use App\Models\Exam;
use App\Models\Question;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Year;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        parent::boot();

        Route::bind('year', function ($value) {
            return Year::withTrashed()->find($value);
        });
        Route::bind('semester', function ($value) {
            return Semester::withTrashed()->find($value);
        });

        Route::bind('subject', function ($value) {
            return Subject::withTrashed()->find($value);
        });
        Route::bind('question', function ($value) {
            return Question::withTrashed()->find($value);
        });
        Route::bind('exam', function ($value) {
            return Exam::withTrashed()->find($value);
        });

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
