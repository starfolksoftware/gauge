<?php

namespace StarfolkSoftware\Gauge;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use StarfolkSoftware\Gauge\Commands\GaugeCommand;

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
            ->hasViews()
            ->hasMigration('create_gauge_table')
            ->hasCommand(GaugeCommand::class);
    }
}
