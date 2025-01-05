<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BackupSeeder extends Seeder
{
    protected $tables = [
        'permissions', 
        'roles',
        'role_has_permissions',
        'model_has_roles',
        'model_has_permissions',
        'categories',
        'category_translations',
        'pages',
        'page_translations',
        'services',
        'service_translations',
        'blogs',
        'blog_translations',
        'users',
        'activity_log',
        'failed_jobs',
        'personal_access_tokens',
        'password_reset_tokens',
        'settings',
        'views',
        'languages',
        'language_lines',
        'translations',
        'media',
        'cache',
        'cache_locks',
        // ... diğer tablolar
    ];

    public function run()
    {
        foreach ($this->tables as $table) {
            if (Schema::hasTable($table)) {
                $data = DB::table($table)->get()->toArray();
                
                // Veriyi JSON dosyasına kaydet
                $json = json_encode($data);
                file_put_contents(
                    database_path("backups/{$table}.json"), 
                    $json
                );
            }
        }
    }

    public function restore()
    {
        foreach ($this->tables as $table) {
            $file = database_path("backups/{$table}.json");
            if (file_exists($file)) {
                $data = json_decode(file_get_contents($file), true);
                DB::table($table)->insert($data);
            }
        }
    }
} 