<?php

namespace IbonAzkoitia\LaravelClickup\Commands;

use Illuminate\Console\Command;

class LaravelClickupCommand extends Command
{
    public $signature = 'laravel-clickup';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
