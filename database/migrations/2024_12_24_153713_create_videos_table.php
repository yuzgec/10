<?php

use App\Enums\StatusEnum;
use App\Enums\VideoEnum;

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
        Schema::create('videos', function (Blueprint $table) {
            $table->id('id');

            $table->foreignId('category_id')->constrained()->onDelete('cascade');

            $table->integer('videoCode')->nullable();
            $table->integer('type')->default(VideoEnum::VIDEO->value);

            $table->string('status')->default(StatusEnum::PUBLISHED->value);
            $table->integer('rank')->nullable();

            $table->date('publish_date')->default(now());
            $table->string('publish_password')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
