<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->string('currency_code'); // USD, EUR, GBP vb.
            $table->decimal('buying_rate', 10, 4);  // Alış
            $table->decimal('selling_rate', 10, 4); // Satış
            $table->decimal('effective_rate', 10, 4); // Efektif
            $table->date('rate_date');
            $table->timestamps();

            // Aynı gün için tekrar kur eklenmemesi için
            $table->unique(['currency_code', 'rate_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('exchange_rates');
    }
}; 