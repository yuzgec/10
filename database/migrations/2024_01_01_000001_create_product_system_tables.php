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

        // 2. Products
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->nullable()->constrained()->nullOnDelete();
            $table->string('type')->default(ProductType::SIMPLE->value);
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->integer('stock')->nullable();
            $table->string('sku')->nullable()->unique();
            $table->boolean('featured')->default(false);
            $table->text('purchase_note')->nullable();
            $table->enum('tax_status', ['taxable', 'none'])->default('taxable');
            $table->string('tax_class')->nullable();
            $table->boolean('manage_stock')->default(true);
            $table->decimal('weight', 10, 2)->nullable();
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

        // 4. Product Attribute Values
        Schema::create('product_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_attribute_id')->constrained()->onDelete('cascade');
            $table->string('value');
            $table->string('slug');
            $table->string('color_code')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 5. Product Variations
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('sku')->unique();
            $table->string('variation_key')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->integer('stock');
            $table->decimal('weight', 10, 2)->nullable();
            $table->decimal('length', 10, 2)->nullable();
            $table->decimal('width', 10, 2)->nullable();
            $table->decimal('height', 10, 2)->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
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
    }

    public function down()
    {
        Schema::dropIfExists('product_translations');
        Schema::dropIfExists('product_variation_attributes');
        Schema::dropIfExists('product_variations');
        Schema::dropIfExists('product_attribute_values');
        Schema::dropIfExists('product_attributes');
        Schema::dropIfExists('products');
        Schema::dropIfExists('brands');
    }
}; 