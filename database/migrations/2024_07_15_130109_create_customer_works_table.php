<?php

use App\Enums\CurrencyEnum;
use App\Enums\OrderStatusEnum;
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
        Schema::create('customer_works', function (Blueprint $table) {
            $table->id();
            $table->string('work_name')->default('Firma Web Sitesi');
            $table->string('work_website')->nullable();
            $table->longText('work_desc')->nullable();
            $table->string('pay_desc')->nullable();
            $table->integer('user_id')->default(1);
            $table->foreignId('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->integer('work_category')->default(1);
            $table->double('work_price',10,2)->default(0);
            $table->string('currency')->default(CurrencyEnum::TRY->value);
            $table->integer('work_payment')->default(OrderStatusEnum::PENDING->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_works');
    }
};
