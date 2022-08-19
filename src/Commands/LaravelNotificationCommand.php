<?php

namespace Nrox\LaravelNotification\Commands;

use Illuminate\Console\Command;

class LaravelNotificationCommand extends Command
{
    public $signature = 'laravel-notification';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
