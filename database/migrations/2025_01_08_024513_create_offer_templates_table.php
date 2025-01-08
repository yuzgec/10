<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_template_items');
        Schema::dropIfExists('offer_templates');
    }
};
