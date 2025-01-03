<?php

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
        Schema::create('video_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->foreignId('video_id')->constrained()->onDelete('cascade');
            $table->unique(['video_id', 'locale']);
            $table->string('locale')->index();

            $table->string('name')->nullable();
            $table->string('slug')->nullable();

            
            $table->longtext('short')->nullable();
            $table->longtext('desc')->nullable();

            //SEO
            $table->string('seoTitle')->nullable();
            $table->string('seoDesc')->nullable();
            $table->string('seoKey')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_translations');
    }
};
