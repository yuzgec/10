<?php

use App\Enums\StatusEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->nestedSet();
            
            $table->boolean('addGoogle')->default(true);
            $table->boolean('addComment')->default(false);
            $table->boolean('deleteContent')->default(false);

            $table->string('status')->default(StatusEnum::PUBLISHED->value);
            $table->integer('rank')->nullable();

            $table->date('publish_date')->default(now());
            $table->string('publish_password')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_category_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_category_id')->constrained()->onDelete('cascade');
            $table->string('locale');
            $table->string('name');
            $table->string('slug');
            $table->longtext('short')->nullable();
            $table->longtext('desc')->nullable();
            $table->string('seoTitle')->nullable();
            $table->string('seoDesc')->nullable();
            $table->string('seoKey')->nullable();
            $table->unique(['product_category_id', 'locale']);
        });

        // Pivot tablo
        Schema::create('category_product', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_category_id')->constrained()->onDelete('cascade');
            $table->primary(['product_id', 'product_category_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_product');
        Schema::dropIfExists('product_category_translations');
        Schema::dropIfExists('product_categories');
    }
}; 