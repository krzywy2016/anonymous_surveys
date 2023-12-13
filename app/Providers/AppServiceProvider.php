<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

use App\Interfaces\SurveyInterface;
use App\Services\SurveyService;

use App\Interfaces\QuestionInterface;
use App\Services\QuestionService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SurveyInterface::class, function(){
            return new SurveyService();
        });
        $this->app->bind(QuestionInterface::class, function(){
            return new QuestionService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
