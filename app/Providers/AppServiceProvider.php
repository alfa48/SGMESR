<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
            //
            $this->app->singleton('variavel_global_grafico', function ($app) {
                return 'bar'; // Valor padrão
                //polarArea
                //line
                //bar
                //scatter
                //doughnut
            });

            $this->app->singleton('variavel_global_bateria', function ($app) {
                return 0; // Valor padrão
                //polarArea
                //line
                //bar
                //scatter
                //doughnut
            });

            $this->app->singleton('variavel_global_painel', function ($app) {
                return 0; // Valor padrão
                //polarArea
                //line
                //bar
                //scatter
                //doughnut
            });
    }
     /**
     * Obtenha o valor da variável global.
     *
     * @return mixed
     */
    public function getVariavelGlobal()
    {
        return $this->app->make('variavel_global_grafico');
    }

    /**
     * Atualize o valor da variável global.
     *
     * @param  string  $novo_valor
     * @return void
     */
    public function setVariavelGlobal($novo_valor)
    {
        // Atualize o valor da variável global
        Cache::forever('variavel_global_grafico', $novo_valor);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Obtenha o valor da variável global do cache
        $valorVariavelGlobal = Cache::get('variavel_global_grafico', 'doughnut'); // Valor padrão é 'doughnut'

        // Compartilhe a variável global com todas as views
        View::share('variavel_global_grafico', $valorVariavelGlobal);
    }
}