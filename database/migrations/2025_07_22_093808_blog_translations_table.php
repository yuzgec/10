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
        Schema::create('blog_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->longtext('short')->nullable();
            $table->longtext('desc')->nullable();

            //SEO
            $table->string('seoTitle')->nullable();
            $table->string('seoDesc')->nullable();
            $table->string('seoKey')->nullable();

            $table->foreignId('blog_id')->constrained()->onDelete('cascade');

            $table->string('locale')->index();
            $table->unique(['blog_id', 'locale']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_translations');
    }
};
