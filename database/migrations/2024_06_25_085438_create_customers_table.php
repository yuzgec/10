<?php

use App\Enums\CurrencyEnum;
use App\Enums\CustomerEnum;
use App\Enums\CustomerMediumEnum;
use App\Enums\CustomerWorkStatusEnum;
use App\Enums\CustomerOfferStatusEnum;
use App\Enums\CustomerOrderStatusEnum;
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
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('customer_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('offer_no')->unique();
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

        Schema::create('customer_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')->constrained('customer_offers')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->date('payment_date');
            $table->integer('status')->default(CustomerOrderStatusEnum::PENDING->value);
            $table->timestamps();
        });

        Schema::create('customer_works', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('offer_id')->constrained('customer_offers')->onDelete('cascade');
            $table->integer('status')->default(CustomerWorkStatusEnum::WORKING->value);
            $table->timestamps();
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
    }
};
