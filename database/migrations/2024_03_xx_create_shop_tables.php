<?php

use App\Enums\ProductTypeEnum;
use App\Enums\ProductAttributeType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(true);
            $table->boolean('featured')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('brand_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name');
            $table->string('slug');
            $table->longText('short')->nullable();
            $table->longText('desc')->nullable();
            $table->string('seoTitle')->nullable();
            $table->string('seoDesc')->nullable();
            $table->string('seoKey')->nullable();
            $table->unique(['brand_id', 'locale']);
            $table->unique(['locale', 'slug']);
        });

        // Ana Ürün Tablosu
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->default(ProductTypeEnum::SIMPLE->value);
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->decimal('special_price', 10, 2)->nullable();
            $table->integer('stock')->nullable();
            $table->boolean('manage_stock')->default(false);
            $table->string('sku')->nullable()->unique();
            $table->string('barcode')->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->integer('warranty')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('featured')->default(false);
            $table->foreignId('brand_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        // Ürün Çevirileri
        Schema::create('product_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name');
            $table->string('slug');
            $table->text('short')->nullable();
            $table->longText('desc')->nullable();
            $table->longText('technical_desc')->nullable();
            $table->longText('cargo_desc')->nullable();
            $table->string('seoTitle')->nullable();
            $table->string('seoDesc')->nullable();
            $table->string('seoKey')->nullable();
            $table->unique(['product_id', 'locale']);
            $table->unique(['locale', 'slug']);
        });

        Schema::create('attrs', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default(ProductAttributeType::SELECT->value);
            $table->boolean('is_searchable')->default(false);
            $table->boolean('is_filterable')->default(false);
            $table->timestamps();
        });

        Schema::create('attr_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attr_id')->constrained()->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name');
            $table->unique(['attr_id', 'locale']);
        });

        Schema::create('attr_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attr_id')->constrained()->cascadeOnDelete();
            $table->string('value')->nullable();
            $table->timestamps();
        });

        Schema::create('attr_value_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attr_value_id')->constrained()->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name');
            $table->unique(['attr_value_id', 'locale']);
        });

        Schema::create('variations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('sku')->nullable()->unique();
            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->decimal('special_price', 10, 2)->nullable();
            $table->integer('stock')->nullable();
            $table->boolean('manage_stock')->default(false);
            $table->string('barcode')->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('variation_attrs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variation_id')->constrained()->cascadeOnDelete();
            $table->foreignId('attr_id')->constrained();
            $table->foreignId('attr_value_id')->constrained();
            $table->unique(['variation_id', 'attr_id']);
        });

        Schema::create('product_categories', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->primary(['product_id', 'category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('variation_attrs');
        Schema::dropIfExists('variations');
        Schema::dropIfExists('attr_value_translations');
        Schema::dropIfExists('attr_values');
        Schema::dropIfExists('attr_translations');
        Schema::dropIfExists('attrs');
        Schema::dropIfExists('product_translations');
        Schema::dropIfExists('products');
        Schema::dropIfExists('brand_translations');
        Schema::dropIfExists('brands');
    }
}; 