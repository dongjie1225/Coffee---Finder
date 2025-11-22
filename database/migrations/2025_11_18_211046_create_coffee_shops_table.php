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
        Schema::create('coffee_shops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // 创建者
            $table->string('name'); // 咖啡店名称
            $table->text('description')->nullable(); // 描述
            $table->string('address')->nullable(); // 地址
            $table->string('phone')->nullable(); // 电话
            $table->string('website')->nullable(); // 网站
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coffee_shops');
    }
};
