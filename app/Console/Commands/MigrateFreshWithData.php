<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Database\Seeders\BackupSeeder;

class MigrateFreshWithData extends Command
{
    protected $signature = 'migrate:fresh-with-data';
    protected $description = 'Refresh migrations while preserving specific table data';

    public function handle()
    {
        // Veriyi yedekle
        $seeder = new BackupSeeder();
        $seeder->run();

        // Migrationları yeniden çalıştır
        $this->call('migrate:fresh');

        // Veriyi geri yükle
        $seeder->restore();

        $this->info('Migration completed with data preservation!');
    }
} 