<?php

namespace App\Providers;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Query\Builder;
use Auth;

use Illuminate\Support\ServiceProvider;

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
        View::composer('*', function($view){
            if (Auth::check()){
                $user_name = Auth::user()->username;
                $user_office = User::leftJoin('offices', 'users.office', '=', 'offices.id')->where('users.username', $user_name)->first(['offices.office', 'users.office as office_id']);

                $view->with(['user_office' => $user_office]);
                
            }
        });

        Builder::macro('search', function($field, $string){
            return $string ? $this->orWhere($field, 'like', '%'.$string.'%') : $this;
        });

    
    }
}
