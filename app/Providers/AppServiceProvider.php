<?php

namespace App\Providers;

<<<<<<< HEAD
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Venta;
use App\Policies\CategoriaPolicy;
use App\Policies\ProductoPolicy;
use App\Policies\VentaPolicy;
use Illuminate\Support\Facades\Gate;
=======
>>>>>>> 1b36d443633a320fb0f7a86bc2d505e5f12769cf
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
<<<<<<< HEAD
=======
    /**
     * Register any application services.
     */
>>>>>>> 1b36d443633a320fb0f7a86bc2d505e5f12769cf
    public function register(): void
    {
        //
    }

<<<<<<< HEAD
    public function boot(): void
    {
        // Registrar Policies
        Gate::policy(Producto::class, ProductoPolicy::class);
        Gate::policy(Categoria::class, CategoriaPolicy::class);
        Gate::policy(Venta::class, VentaPolicy::class);

        // Gates por rol
        Gate::define('es-administrador', function ($usuario) {
            return $usuario->esAdministrador();
        });

        Gate::define('es-gerente', function ($usuario) {
            return $usuario->esGerente();
        });

        Gate::define('es-cliente', function ($usuario) {
            return $usuario->esCliente();
        });

        Gate::define('administrador-o-gerente', function ($usuario) {
            return $usuario->esAdministrador() || $usuario->esGerente();
        });
=======
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
>>>>>>> 1b36d443633a320fb0f7a86bc2d505e5f12769cf
    }
}
