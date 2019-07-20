<?php

namespace Zakhayko\Settings\Commands;

use Illuminate\Console\Command;

class SettingsForget extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'settings:forget {key}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes attribute from "settings.json."';

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
        $key = $this->argument('key');
        if (!settings()->has($key)) {
            $this->error('Attribute "'.$key.'" does not exist.');
        }
        else {
            settings()->forget($key);
            $this->info('Removed attribute "'.$key.'".');
        }
    }
}
