<?php

use App\Enums\PaymentTypeEnum;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreignId('work_id')->references('id')->on('customer_works')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->double('amount_paid',10,2)->default(0);
            $table->double('debt_amount',10,2)->default(0);
            $table->date('payment_date')->nullable();
            $table->date('debt_payment_date')->nullable();
            $table->boolean('send_mail')->default(false);
            $table->boolean('send_sms')->default(false);
            $table->string('invoice_number')->nullable();
            $table->integer('payment_type')->default(PaymentTypeEnum::EFT->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
