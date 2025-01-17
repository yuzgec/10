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
        Schema::create('image_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
                      
            $table->boolean('addGoogle')->default(true);
            $table->boolean('addComment')->default(false);
            $table->boolean('deleteContent')->default(false);

            $table->string('status')->default(StatusEnum::PUBLISHED->value);
            $table->integer('rank')->nullable();

            $table->date('publish_date')->default(now());

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_galleries');
    }
};
