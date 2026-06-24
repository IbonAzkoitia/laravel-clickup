<?php

namespace IbonAzkoitia\Clickup\Commands;

use Illuminate\Console\Command;

class ClickupCommand extends Command
{
    public $signature = 'clickup';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
