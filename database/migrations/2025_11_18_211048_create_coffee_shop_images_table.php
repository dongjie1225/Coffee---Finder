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
        Schema::create('coffee_shop_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coffee_shop_id')->constrained()->onDelete('cascade'); // 关联咖啡店
            $table->string('title'); // 图片标题（必需）
            $table->text('description')->nullable(); // 图片描述（必需）
            $table->string('image_path'); // 图片文件路径
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coffee_shop_images');
    }
};
