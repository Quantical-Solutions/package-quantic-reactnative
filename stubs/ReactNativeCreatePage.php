<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Quantic\ReactNative\Commands\Listener;

class ReactNativeCreatePage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reactnative:create 
                            {file? : File to create}
                            {--type=null : Document type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create page component for ReactNativeCreatePage App compilation from Blade & Tailwind';

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
        $arg = $this->argument('file');
        $option = $this->option('type');

        // Execute Quantical Solutions ReactNative command
        new Listener($this, 'create', $arg, $option);
    }
}
