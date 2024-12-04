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
        Schema::create('faq_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->longtext('desc')->nullable();

            $table->unsignedBigInteger('faq_id')->unsigned();
            $table->string('locale')->index();

            $table->unique(['faq_id', 'locale']);
            $table->foreign('faq_id')->references('id')->on('faq')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faq_translations');
    }
};
