<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SetupApplication extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:application';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */

    public function handle()
    {
        //create Seeders
        Artisan::call('make:seeder', ['name' => 'DatabaseSeeder']);
        $this->info('Seeder created successfully.');

        // Seed the database
        $this->info('Running migrations...');
        Artisan::call('migrate');
        $this->info('Migrations completed successfully.');

        // Seed the database and insert the fake data
        $this->info('Seeding the database...');
        Artisan::call('db:seed');
        $this->info('Database seeding completed successfully.');

        // Start the server
        $this->info('Starting the server...');
        Artisan::call('serve --port=5173');
    }
    
    
}
