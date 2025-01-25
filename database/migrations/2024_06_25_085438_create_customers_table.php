<?php

use App\Enums\CurrencyEnum;
use App\Enums\CustomerEnum;
use App\Enums\CustomerMediumEnum;
use App\Enums\CustomerWorkStatusEnum;
use App\Enums\CustomerOfferStatusEnum;
use App\Enums\CustomerOrderStatusEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Enums\CustomerWorkPaymentStatusEnum;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('offer_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('currency')->default('TRY');
            $table->text('description')->nullable();
            $table->text('terms')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });

        Schema::create('offer_template_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_template_id')->constrained()->onDelete('cascade');
            $table->string('item_name');
            $table->integer('unit')->default(1);
            $table->decimal('amount', 10, 2);
            $table->decimal('discount', 5, 2)->default(0);
            $table->decimal('tax', 5, 2)->default(20);
            $table->timestamps();
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('authorized_person')->nullable();
            $table->string('staff_name')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('tax_place')->nullable();
            $table->string('email1')->nullable();
            $table->string('email2')->nullable();
            $table->string('address')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('mobile')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('website1')->nullable();
            $table->string('website2')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('youtube')->nullable();
            $table->string('googlemaps')->nullable();
            $table->string('note')->nullable();
            $table->integer('city_id')->default(35);
            $table->integer('district_id')->default(76);
            $table->integer('user_id')->default(1);
            $table->integer('status')->default(CustomerEnum::NEW->value);
            $table->integer('medium')->default(CustomerMediumEnum::UNKNOWN->value);
            $table->date('firstdate_at')->default(now());
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('customer_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('offer_no')->unique();
            $table->foreignId('template_id')->nullable()->constrained('offer_templates')->nullOnDelete();
            $table->string('name');
            $table->text('desc')->nullable();
            $table->enum('currency', array_column(CurrencyEnum::cases(), 'value'))->default(CurrencyEnum::TL->value);
            $table->date('offer_date');
            $table->date('valid_until')->nullable();
            $table->integer('status')->default(CustomerOfferStatusEnum::OFFER->value);
            $table->text('note')->nullable();
            $table->text('terms')->nullable();
            $table->boolean('is_sent')->default(false);
            $table->timestamp('sent_at')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('customer_offer_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')->constrained('customer_offers')->onDelete('cascade');
            $table->string('item_name');
            $table->integer('unit');
            $table->decimal('amount', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('tax', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });

        Schema::create('customer_works', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('offer_id')->constrained('customer_offers')->onDelete('cascade');
            $table->integer('status')->default(CustomerWorkStatusEnum::PENDING->value);
            $table->date('start_date');
            $table->date('delivery_date');
            $table->date('completed_date')->nullable();
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->integer('progress')->default(0);
            $table->decimal('total_amount', 10, 2);
            $table->decimal('advance_payment', 10, 2)->default(0);
            $table->decimal('remaining_payment', 10, 2)->default(0);
            $table->decimal('total_paid', 10, 2)->default(0);
            $table->decimal('total_remaining', 10, 2)->default(0);
            $table->integer('payment_status')->default(CustomerWorkPaymentStatusEnum::PENDING->value);
            $table->date('last_payment_date')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });



        Schema::create('customer_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')->constrained('customer_offers')->onDelete('cascade');
            $table->foreignId('customer_work_id')->constrained('customer_works')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->date('payment_date');
            $table->enum('payment_type', ['advance', 'progress', 'final']);
            $table->text('description')->nullable();
            $table->integer('status')->default(CustomerOrderStatusEnum::PENDING->value);
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });


        
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
        Schema::dropIfExists('customer_offers');
        Schema::dropIfExists('customer_offer_items');
        Schema::dropIfExists('customer_payments');
        Schema::dropIfExists('customer_works');
        Schema::dropIfExists('offer_template_items');
        Schema::dropIfExists('offer_templates');
        Schema::dropIfExists('exchange_rates');
    }
};
