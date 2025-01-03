<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faq_translations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('faq_id')->constrained('faq')->onDelete('cascade');
            $table->string('locale')->index();
            $table->unique(['faq_id', 'locale']);

            $table->string('name')->nullable();
            $table->longtext('desc')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faq_translations');
    }
};
