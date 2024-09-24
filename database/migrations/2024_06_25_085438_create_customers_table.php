<?php

use App\Enums\MediumEnum;
use App\Enums\CustomerEnum;
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
            $table->string('email')->nullable();
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
            $table->string('googlemaps_name')->nullable();
            $table->string('province')->default('İZMİR');
            $table->string('city')->nullable();
            $table->integer('user_id')->default(1);
            $table->string('status')->default(CustomerEnum::NEW->value);
            $table->string('medium')->default(MediumEnum::UNKNOWN->value);
            $table->date('firstdate_at')->default(now());
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
