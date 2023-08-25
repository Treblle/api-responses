<?php

declare(strict_types=1);

namespace Treblle\ApiResponses\Providers;

use Illuminate\Support\ServiceProvider;

final class PackageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/api.php' => config_path('api.php'),
            ], 'api-config');
        }
    }
}
