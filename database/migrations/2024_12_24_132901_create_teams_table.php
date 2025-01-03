<?php

use App\Enums\StatusEnum;
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
        Schema::create('teams', function (Blueprint $table) {
            $table->id('id');

            $table->foreignId('category_id')->constrained()->onDelete('cascade');

            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('pinterest')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();

            $table->string('status')->default(StatusEnum::PUBLISHED->value);
            $table->integer('rank')->nullable();

            $table->date('publish_date')->default(now());
            $table->string('publish_password')->nullable();

            
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
