<?php

namespace StarfolkSoftware\Gauge\Commands;

use Illuminate\Console\Command;

class GaugeCommand extends Command
{
    public $signature = 'gauge';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
