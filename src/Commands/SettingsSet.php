<?php

namespace Zakhayko\Settings\Commands;

use Illuminate\Console\Command;

class SettingsSet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'settings:set {key} {value?} {--int} {--bool} {--null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets "settings.json" value.';

    private $key;
    private $value;

    /**
     * Create a new command instance.
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
        $value = $this->argument('value');
        if ($this->option('null')) {
            $value = null;
            $valueInfo = 'null';
        }
        elseif ($this->option('bool')) {
            if ($value && $value!=='false') {
                $value = true;
                $valueInfo = 'true';
            }
            else {
                $value = false;
                $valueInfo = 'false';
            }
        }
        elseif ($this->option('int')) {
            $value = (int) $value;
            $valueInfo = (string) $value;
        }
        else {
            $value = (string) $value;
            $valueInfo = '"'.$value.'"';
        }
        settings([$key=>$value]);
        $this->info('Changed ["'.$key.'"=>'.$valueInfo.'].');
    }
}
