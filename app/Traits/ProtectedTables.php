<?php

namespace App\Traits;

trait ProtectedTables
{
    /**
     * Fresh/Reset sırasında korunacak tablolar
     */
    public static function getProtectedTables(): array
    {
        return [];
    }

    /**
     * Tablonun korunup korunmadığını kontrol et
     */
    public function isProtectedTable(string $tableName): bool
    {
        return in_array($tableName, static::getProtectedTables());
    }
} 