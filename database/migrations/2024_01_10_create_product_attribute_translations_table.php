<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('product_attribute_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_attribute_id')->constrained('product_attributes')->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('name');
            $table->string('slug');
            
            $table->unique(['product_attribute_id', 'locale'], 'pat_attribute_locale_unique');
            $table->unique(['locale', 'slug'], 'pat_locale_slug_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_attribute_translations');
    }
}; 