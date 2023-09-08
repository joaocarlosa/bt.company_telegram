<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FetchTelegramUpdates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:fetch-updates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch updates from Telegram API';   
    

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}
