<?php

use App\Enums\SettingsEnum;
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
 
        Schema::create('language_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('group')->index();
            $table->string('key');
            $table->json('text');
            $table->timestamps();
        });

        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('lang', 2);
            $table->string('name');
            $table->string('native');
            $table->integer('rank')->nullable();
            $table->string('regional');
            $table->string('script')->nullable();
            $table->boolean('active')->default(false);
            $table->timestamps();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');

            $table->string('item');
            $table->string('value')->nullable();
            $table->boolean('isImage')->default(false);
            
            $table->integer('isType')->default(SettingsEnum::INPUT->value);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('languages');
        Schema::dropIfExists('language_lines');
    }
};

