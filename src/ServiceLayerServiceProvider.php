<?php

namespace Felipetti\ServiceLayer;

use Felipetti\ServiceLayer\Commands\MakeServiceCommand;
use Felipetti\ServiceLayer\Commands\MakeAllCommand;
use Illuminate\Support\ServiceProvider;
use Felipetti\ServiceLayer\Data\Data;

class ServiceLayerServiceProvider extends ServiceProvider
{
    // This is the name of the package.
    private string $packageName = 'service-layer';

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
       //
    }

    /**
     * Bootstrap any application services.
     *
     * @param Data $data
     * @return void
     */
    public function boot(Data $data): void
    {
        $nameOfConfigTag = $this->packageName . '-config';
        $nameOfStubTag = $this->packageName . '-stub';

        if ($this->app->runningInConsole()) {
            $this->commands([MakeServiceCommand::class, MakeAllCommand::class,]);
        }

        $configPaths = [$data->getSourceConfigPath() => config_path($data->getConfigFileName())];
        $stubPaths = [$data->getSourceStubPath() => $data->getPublishStubPath()];

        $this->publishes($configPaths, $nameOfConfigTag);
        $this->publishes($stubPaths, $nameOfStubTag);
    }
}

