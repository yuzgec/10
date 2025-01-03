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
        Schema::create('team_translations', function (Blueprint $table) {

            $table->id();
            $table->foreignId('team_id')->constrained()->onDelete('cascade');
            $table->string('locale')->index();
            $table->unique(['team_id', 'locale']);

            $table->string('name')->nullable();
            $table->string('company')->nullable();
            $table->string('jobTitle')->nullable();
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
        Schema::dropIfExists('team_translations');
    }
};
