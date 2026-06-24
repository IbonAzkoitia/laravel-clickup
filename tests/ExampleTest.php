<?php

use IbonAzkoitia\Clickup\Commands\ClickupCommand;
use Illuminate\Console\Command;

use function Pest\Laravel\artisan;

it('can test', function () {
    artisan(ClickupCommand::class)->assertExitCode(Command::SUCCESS);
});
