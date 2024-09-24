<?php

use App\Enums\CurrencyEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer_offers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('desc')->nullable();
            $table->integer('user_id')->default(1);
            $table->integer('category')->default(1);
            $table->double('offer',10,2)->default(0);
            $table->string('currency')->default(CurrencyEnum::TRY->value);
            $table->boolean('send_mail')->default(false);
            $table->boolean('send_sms')->default(false);
            $table->foreignId('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_offers');
    }
};
