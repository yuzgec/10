<?php

use App\Enums\StatusEnum;
use App\Enums\ProductType;
use App\Enums\ProductAttributeType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        // 1. Brands
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        
        Schema::create('tax_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->decimal('rate', 5, 2);
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });

        // 2. Products
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->nullable()->constrained()->nullOnDelete();
            $table->string('type')->default(ProductType::SIMPLE->value);
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->integer('stock')->nullable();
            $table->string('sku')->unique();
            $table->boolean('featured')->default(false);
            $table->text('purchase_note')->nullable();
            $table->enum('tax_status', ['taxable', 'none'])->default('taxable');
            $table->foreignId('tax_class_id')->nullable()->constrained();
            $table->boolean('manage_stock')->default(false);
            $table->integer('min_stock_level')->nullable();
            $table->integer('max_stock_level')->nullable();
            $table->enum('stock_status', ['in_stock', 'out_of_stock', 'on_backorder'])->default('in_stock');
            $table->boolean('allow_backorders')->default(false);
            $table->boolean('notify_low_stock')->default(false);
            $table->integer('low_stock_threshold')->nullable();
            $table->boolean('show_stock_quantity')->default(true);
            $table->boolean('requires_shipping')->default(false);
            $table->integer('delivery_time')->nullable();
            $table->decimal('weight', 10, 2)->nullable();
            $table->integer('warranty_period')->nullable();
            $table->string('manufacturing_place')->nullable();
            $table->string('barcode')->nullable();
            $table->string('dimension_unit')->nullable();
            $table->decimal('length', 10, 2)->nullable();
            $table->decimal('width', 10, 2)->nullable();
            $table->decimal('height', 10, 2)->nullable();
            $table->string('external_url')->nullable();
            $table->string('button_text')->nullable();
            $table->boolean('addGoogle')->default(true);
            $table->boolean('addComment')->default(false);
            $table->boolean('deleteContent')->default(false);
            $table->string('status')->default(StatusEnum::PUBLISHED->value);
            $table->integer('rank')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // 3. Product Attributes
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default(ProductAttributeType::SELECT->value); // enum yerine string kullanıyoruz
            $table->boolean('status')->default(true);
            $table->integer('rank')->default(0);
            $table->timestamps();
        });

        Schema::create('product_attribute_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_attribute_id')->constrained('product_attributes')->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('name');
            $table->string('slug');
            
            $table->unique(['product_attribute_id', 'locale'], 'pat_attribute_locale_unique');
            $table->unique(['locale', 'slug'], 'pat_locale_slug_unique');
        });

        // Product Attribute Values tablosu
        Schema::create('product_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_attribute_id')->constrained()->onDelete('cascade');
            $table->string('color_code')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Product Attribute Value Translations tablosu
        Schema::create('p_attr_val_trans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_attribute_value_id');
            $table->string('locale');
            $table->string('value');
            $table->string('slug');
            
            $table->foreign('product_attribute_value_id')
                ->references('id')
                ->on('product_attribute_values')
                ->onDelete('cascade');
        });

        // 5. Product Variations
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('sku')->unique();
            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->integer('stock');
            $table->boolean('status')->default(true);
            $table->string('variation_key')->nullable();
            $table->timestamps();
        });

        // Product Variation Translations
        Schema::create('p_var_trans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variation_id')->constrained('product_variations')->onDelete('cascade');
            $table->string('locale');
            $table->string('name');
            $table->string('slug');
            
            $table->unique(['product_variation_id', 'locale']);
        });

        // 6. Product Variation Attributes
        Schema::create('product_variation_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variation_id')->constrained('product_variations')->onDelete('cascade');
            $table->foreignId('attribute_id')->constrained('product_attributes');
            $table->foreignId('value_id')->constrained('product_attribute_values');
            $table->timestamps();

            $table->unique(['variation_id', 'attribute_id']);
        });

        // 7. Translations
        Schema::create('product_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('locale');
            $table->string('name');
            $table->string('slug');
            $table->text('short')->nullable();
            $table->longText('desc')->nullable();

            $table->string('button_text')->nullable();
            $table->string('external_url_text')->nullable();
            $table->text('purchase_note')->nullable();

            $table->string('campaign_text')->nullable();
            $table->string('cargo_text')->nullable();
            $table->string('warranty_text')->nullable();
            $table->string('pay_text')->nullable();
            $table->string('return_text')->nullable();
            $table->string('exchange_text')->nullable();
            $table->string('refund_text')->nullable();
            $table->string('cancel_text')->nullable();
            $table->string('contact_text')->nullable();


            $table->text('seoKey')->nullable();
            $table->text('seoDesc')->nullable();
            $table->text('seoTitle')->nullable();

            $table->timestamps();

            $table->unique(['product_id', 'locale']);
            $table->unique(['locale', 'slug']);
        });


        Schema::create('product_attribute_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('attribute_id')->constrained('product_attributes')->onDelete('cascade');
            $table->foreignId('value_id')->constrained('product_attribute_values')->onDelete('cascade');
            $table->timestamps();

            // Unique constraint ekleyelim
            $table->unique(['product_id', 'attribute_id']);
        });

        
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

        // Related Products pivot table
        Schema::create('related_products', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('related_product_id')->constrained('products')->onDelete('cascade');
            $table->timestamps();
            $table->primary(['product_id', 'related_product_id']);
        });

        Schema::create('product_related', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('related_product_id')->constrained('products')->onDelete('cascade');
            $table->primary(['product_id', 'related_product_id']);
        });

    }

    public function down()
    {
        Schema::dropIfExists('brands');
        Schema::dropIfExists('tax_classes');
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_translations');
        Schema::dropIfExists('product_variation_attributes');
        Schema::dropIfExists('product_variations');
        Schema::dropIfExists('product_attribute_values');
        Schema::dropIfExists('product_attributes');
        Schema::dropIfExists('category_product');
        Schema::dropIfExists('product_category_translations');
        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('product_attribute_relations');
        Schema::dropIfExists('product_attribute_translations');
        Schema::dropIfExists('p_attr_val_trans');
        Schema::dropIfExists('p_var_trans');
        Schema::dropIfExists('product_variation_attributes');
        Schema::dropIfExists('related_products');
        Schema::dropIfExists('product_related');
    }
}; 