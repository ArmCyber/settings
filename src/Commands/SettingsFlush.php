<?php

namespace Zakhayko\Settings\Commands;

use Illuminate\Console\Command;

class SettingsFlush extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'settings:flush';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes "settings.json" file.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!count(settings()->all())) {
            $this->warn('Nothing to remove.');
        }
        else {
            settings()->flush();
            $this->info('Flushed.');
        }
    }
}
