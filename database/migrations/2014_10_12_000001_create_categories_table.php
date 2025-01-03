<?php

use App\Enums\StatusEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->nestedSet();
            $table->string('status')->default(StatusEnum::PUBLISHED->value);
            $table->integer('rank')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('category_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('name');
            $table->string('slug');
            $table->longtext('short')->nullable();
            $table->longtext('desc')->nullable();
            $table->string('seoTitle')->nullable();
            $table->string('seoDesc')->nullable();
            $table->string('seoKey')->nullable();
            $table->unique(['category_id', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_translations');
        Schema::dropIfExists('categories');
    }
}; 