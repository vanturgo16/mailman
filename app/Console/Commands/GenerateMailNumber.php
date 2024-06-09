<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateMailNumber extends Command
{
    protected $signature = 'GenerateMailNumber';
    protected $description = 'Generate Number of Email';

    public function handle()
    {
        return Command::SUCCESS;
    }
}
