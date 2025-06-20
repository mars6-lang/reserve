<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Users\products; // Make sure you import your Product model
use Carbon\Carbon; // For time comparison

class DeleteOldProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * You will run this via: php artisan app:delete-old-products
     *
     * @var string
     */
    protected $signature = 'app:delete-old-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete products that are older than 16 hours';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cutoff = Carbon::now()->subHours(16);

        $count = products::where('created_at', '<', $cutoff)->delete();

        $this->info("Deleted {$count} products older than 16 hours.");
    }
}