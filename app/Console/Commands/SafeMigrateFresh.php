<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Traits\ProtectedTables;

class SafeMigrateFresh extends Command
{
    use ProtectedTables;

    protected $signature = 'migrate:safe-fresh';
    protected $description = 'Safely refresh database while keeping protected tables';

    public function handle()
    {
        // Korunacak tabloların verilerini yedekle
        $backups = [];
        foreach ($this->getProtectedTables() as $table) {
            if (Schema::hasTable($table)) {
                $backups[$table] = DB::table($table)->get();
            }
        }

        // Migration'ları yeniden çalıştır
        $this->call('migrate:fresh');

        // Yedeklenen verileri geri yükle
        foreach ($backups as $table => $data) {
            foreach ($data as $row) {
                DB::table($table)->insert((array) $row);
            }
            $this->info("Restored table: {$table}");
        }

        $this->info('Safe migration completed successfully!');
    }
} 