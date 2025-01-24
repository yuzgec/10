<?php

use App\Enums\StatusEnum;
use App\Enums\ProductTypeEnum;
use App\Enums\ProductAttributeType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        // 1. Ana Ürün Tablosu
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->default(ProductTypeEnum::SIMPLE->value);
            $table->boolean('status')->default(true);
            $table->integer('rank')->nullable();
            $table->string('sku')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->integer('stock')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        // 2. Ürün Çevirileri
        Schema::create('product_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade')->name('pt_prod_fk');
            $table->string('locale')->index();
            
            $table->string('name');
            $table->string('slug');
            $table->longtext('short')->nullable();
            $table->longtext('desc')->nullable();
            
            $table->string('seoTitle')->nullable();
            $table->string('seoDesc')->nullable();
            $table->string('seoKey')->nullable();

            $table->unique(['product_id', 'locale'], 'pt_uniq');
        });

        // 3. Özellikler Tablosu
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->default(ProductAttributeType::SELECT->value); // Renk, Beden gibi özellik tipleri için
            $table->integer('status')->default(StatusEnum::PUBLISHED->value);
            $table->integer('rank')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // 4. Özellik Çevirileri
        Schema::create('product_attribute_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_attribute_id')->constrained()->onDelete('cascade')->name('pat_attr_fk');
            $table->string('locale')->index();
            
            $table->string('name');
            $table->string('slug');
            
            $table->unique(['product_attribute_id', 'locale'], 'pat_uniq');
        });

        // 5. Özellik Değerleri
        Schema::create('product_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_id')
                ->constrained('product_attributes')
                ->onDelete('cascade')
                ->name('pav_attr_fk');
            $table->string('color_code')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('rank')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // 6. Özellik Değer Çevirileri
        Schema::create('product_attribute_value_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_attribute_value_id')
                ->constrained('product_attribute_values')
                ->onDelete('cascade')
                ->name('pavt_val_fk');
            $table->string('locale')->index();
            
            $table->string('name');
            $table->string('slug');
            
            $table->unique(['product_attribute_value_id', 'locale'], 'pavt_uniq');
        });

        // 7. Ürün Varyasyonları
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade')->name('pv_prod_fk');
            $table->string('sku')->unique();
            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->integer('stock')->default(0);
            $table->boolean('status')->default(true);
            $table->boolean('is_default')->default(false);
            $table->integer('rank')->nullable();
            $table->integer('sort_order')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // 8. Varyasyon Değerleri
        Schema::create('variation_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variation_id')->constrained('product_variations')->onDelete('cascade')->name('vv_var_fk');
            $table->foreignId('attribute_id')->constrained('product_attributes')->onDelete('cascade')->name('vv_attr_fk');
            $table->foreignId('value_id')->constrained('product_attribute_values')->onDelete('cascade')->name('vv_val_fk');
            $table->timestamps();
        });

        // 9. Kategori Ürün İlişkisi
        Schema::create('category_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->constrained()
                ->onDelete('cascade')
                ->name('cp_cat_fk');
            $table->foreignId('product_id')
                ->constrained()
                ->onDelete('cascade')
                ->name('cp_prod_fk');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_product');
        Schema::dropIfExists('variation_values');
        Schema::dropIfExists('product_variations');
        Schema::dropIfExists('product_attribute_value_translations');
        Schema::dropIfExists('product_attribute_values');
        Schema::dropIfExists('product_attribute_translations');
        Schema::dropIfExists('product_attributes');
        Schema::dropIfExists('product_translations');
        Schema::dropIfExists('products');
    }
}; 