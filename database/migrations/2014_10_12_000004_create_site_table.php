<?php

use App\Enums\StatusEnum;
use App\Traits\ProtectedTables;
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

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            
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

        Schema::create('page_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->onDelete('cascade');
            $table->string('locale')->index();
            $table->unique(['page_id', 'locale']);


            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->longtext('short')->nullable();
            $table->longtext('desc')->nullable();

            //SEO
            $table->string('seoTitle')->nullable();
            $table->string('seoDesc')->nullable();
            $table->string('seoKey')->nullable();

        });

        Schema::create('faq', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            
            $table->string('status')->default(StatusEnum::PUBLISHED->value);
            $table->integer('rank')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('faq_translations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('faq_id')->constrained('faq')->onDelete('cascade');
            $table->string('locale')->index();
            $table->unique(['faq_id', 'locale']);

            $table->string('name')->nullable();
            $table->longtext('desc')->nullable();
        });

        Schema::create('faqables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faq_id')->references('id')->on('faq')->onDelete('cascade');
            $table->morphs('faqable'); // Polymorphic relation (faqable_id and faqable_type)
            $table->timestamps();
        });

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

        Schema::create('team_translations', function (Blueprint $table) {

            $table->id();
            $table->foreignId('team_id')->constrained()->onDelete('cascade');
            $table->string('locale')->index();
            $table->unique(['team_id', 'locale']);

            $table->string('name')->nullable();
            $table->string('company')->nullable();
            $table->string('jobTitle')->nullable();
            $table->string('slug')->nullable();
            $table->longtext('short')->nullable();
            $table->longtext('desc')->nullable();

            //SEO
            $table->string('seoTitle')->nullable();
            $table->string('seoDesc')->nullable();
            $table->string('seoKey')->nullable();
           
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
          
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

        Schema::create('service_translations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->string('locale')->index();
            $table->unique(['service_id', 'locale']);


            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->longtext('short')->nullable();
            $table->longtext('desc')->nullable();

            //SEO
            $table->string('seoTitle')->nullable();
            $table->string('seoDesc')->nullable();
            $table->string('seoKey')->nullable();

            $table->timestamps();
        });

        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');

            $table->boolean('addGoogle')->default(true);
            $table->boolean('addComment')->default(false);
            $table->boolean('deleteContent')->default(false);

            $table->string('status')->default(StatusEnum::PUBLISHED->value);
            $table->integer('rank')->nullable();

            $table->date('publish_date')->default(now());
            $table->string('publish_password')->nullable();
            
            $table->longtext('searchText')->nullable();

            $table->timestamps();
            $table->softDeletes();

        });
        
        Schema::create('blog_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->longtext('short')->nullable();
            $table->longtext('desc')->nullable();

            //SEO
            $table->string('seoTitle')->nullable();
            $table->string('seoDesc')->nullable();
            $table->string('seoKey')->nullable();

            $table->foreignId('blog_id')->constrained()->onDelete('cascade');

            $table->string('locale')->index();
            $table->unique(['blog_id', 'locale']);

            $table->timestamps();
        });

        Schema::create('contacts', function (Blueprint $table) {

            $table->id();
            $table->string('name')->nullable();
            $table->string('lang')->default('tr');
            $table->string('company')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->longText('message')->nullable();
            $table->string('subject')->nullable();
            $table->string('service')->nullable();
            $table->string('product')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('referer')->nullable();

            $table->boolean('read')->default(false);
            $table->integer('read_user')->nullable();
            $table->integer('favorite')->default(0);

            $table->timestamps();
            $table->softDeletes();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
        Schema::dropIfExists('page_translations');
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('blog_translations');
        Schema::dropIfExists('services');
        Schema::dropIfExists('service_translations');
        Schema::dropIfExists('teams');
        Schema::dropIfExists('team_translations');
        Schema::dropIfExists('faq');
        Schema::dropIfExists('faq_translations');
        Schema::dropIfExists('faqables');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('category_translations');
        Schema::dropIfExists('contacts');
        
    }
};
