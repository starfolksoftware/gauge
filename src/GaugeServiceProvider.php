<?php

namespace StarfolkSoftware\Gauge;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use StarfolkSoftware\Gauge\Commands\InstallCommand;

class GaugeServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('gauge')
            ->hasConfigFile()
            ->hasCommand(InstallCommand::class);

        if (Gauge::$runsMigrations) {
            $package->hasMigration('create_gauge_table');
        }
    }
}
