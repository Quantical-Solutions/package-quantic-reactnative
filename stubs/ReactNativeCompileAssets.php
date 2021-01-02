<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Quantic\ReactNative\Commands\Listener;

class ReactNativeCompileAssets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reactnative:compile 
                            {extension : File type .css or .js}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compile CSS files or JS files where sources come from config(\'reactnative.css\') or config(\'reactnative.js\')';

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
     * @return void
     */
    public function handle(): void
    {
        $arg = $this->argument('extension');
        $command = $this->argument('command');
        $method = (strpos($command, ':') > 0) ? explode(':', $command)[1] : '';

        // Execute Quantical Solutions ReactNative command
        new Listener($this, $method, $arg, false);
    }
}
