<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Quantic\ReactNative\Commands\Listener;

class ReactNativeFromURL extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reactnative:url 
                            {url? : URL for WebView source}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a ReactNative App from an URL';

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
        $arg = $this->argument('url');
        $command = $this->argument('command');
        $method = (strpos($command, ':') > 0) ? explode(':', $command)[1] : '';

        // Execute Quantical Solutions ReactNative command
        new Listener($this, $method, $arg, false);
    }
}
