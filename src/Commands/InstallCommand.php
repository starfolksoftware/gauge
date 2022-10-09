<?php

namespace StarfolkSoftware\Gauge\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    public $signature = 'gauge:install';

    public $description = 'Install the Gauge package and resources';

    public function handle(): int
    {
        // Publish...
        $this->callSilent('vendor:publish', ['--tag' => 'gauge-config', '--force' => true]);
        $this->callSilent('vendor:publish', ['--tag' => 'gauge-migrations', '--force' => true]);

        // Models...
        copy(__DIR__.'/../../stubs/app/Models/Review.php', app_path('Models/Review.php'));

        // Factories
        copy(__DIR__.'/../../stubs/database/factories/ReviewFactory.php', app_path('../database/factories/ReviewFactory.php'));

        // Policies...
        copy(__DIR__.'/../../stubs/app/Policies/ReviewPolicy.php', app_path('Policies/ReviewPolicy.php'));

        // Service Providers...
        copy(__DIR__.'/../../stubs/app/Providers/GaugeServiceProvider.php', app_path('Providers/GaugeServiceProvider.php'));

        $this->installServiceProviderAfter('RouteServiceProvider', 'GaugeServiceProvider');

        return self::SUCCESS;
    }

    /**
     * Install the service provider in the application configuration file.
     *
     * @param  string  $after
     * @param  string  $name
     * @return void
     */
    protected function installServiceProviderAfter($after, $name)
    {
        if (! Str::contains($appConfig = file_get_contents(config_path('app.php')), 'App\\Providers\\'.$name.'::class')) {
            file_put_contents(config_path('app.php'), str_replace(
                'App\\Providers\\'.$after.'::class,',
                'App\\Providers\\'.$after.'::class,'.PHP_EOL.'        App\\Providers\\'.$name.'::class,',
                $appConfig
            ));
        }
    }
}
