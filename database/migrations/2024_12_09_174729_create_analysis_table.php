<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('analysis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('normalized_url');
            $table->string('folder_name'); // Yeni alan
            $table->string('desktop_image')->nullable();
            $table->string('mobile_image')->nullable();
            $table->string('ip')->nullable();
            $table->string('lang')->default('tr');
            $table->boolean('read')->default(false);
            $table->integer('read_author')->default(1);
            $table->boolean('send_mail')->default(false);
            $table->boolean('send_offer')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('analysis');
    }
};
