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
        Schema::create('product_translations', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->longtext('short')->nullable();
            $table->longtext('desc')->nullable();

            $table->string('cargo_text')->nullable();
            $table->string('campagin_text')->nullable();
            $table->string('payment_text')->nullable();

            $table->string('tab1_name')->nullable();
            $table->longtext('tab1_content')->nullable();
            $table->string('tab2_name')->nullable();
            $table->longtext('tab2_content')->nullable();
            $table->string('tab3_name')->nullable();
            $table->longtext('tab3_content')->nullable();
            $table->string('tab4_name')->nullable();
            $table->longtext('tab4_content')->nullable();
            $table->string('tab5_name')->nullable();
            $table->longtext('tab5_content')->nullable();

            //SEO
            $table->string('seoTitle')->nullable();
            $table->string('seoDesc')->nullable();
            $table->string('seoKey')->nullable();


            $table->unsignedBigInteger('product_id')->unsigned();
            $table->string('locale')->index();

            $table->unique(['product_id', 'locale']);
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_translations');
    }
};
