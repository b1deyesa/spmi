<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
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
        // Custom URL macro
        URL::macro('routeWithFakultas', function ($name, $parameters = [], $absolute = true) {
            if (!is_array($parameters)) {
                $parameters = [$parameters];
            }

            if (!isset($parameters['fakultas'])) {
                $fakultas = request()->route('fakultas');

                if ($fakultas instanceof \App\Models\Fakultas) {
                    $parameters['fakultas'] = $fakultas->getRouteKey();
                } elseif ($fakultas) {
                    $parameters['fakultas'] = $fakultas;
                } else {
                    $parameters['fakultas'] = session('fakultas_id');
                }
            }

            return route($name, $parameters, $absolute);
        });

        Blade::if('role', function ($roles) {
            if (!Auth::check()) return false;
    
            $userRole = Auth::user()->role->name;
    
            if (is_array($roles)) {
                return in_array($userRole, $roles);
            }
    
            return $userRole === $roles;
        });    
    }
}
