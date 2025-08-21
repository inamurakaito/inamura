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
Schema::create('products', function (Blueprint $table) {
    $table->id();

    // ① まずはidカラムだけ用意（この行では外部キーは付けない）
    $table->foreignId('company_id');

    $table->string('name', 100);
    $table->string('sku', 64)->unique()->nullable();
    $table->unsignedInteger('price');
    $table->unsignedInteger('stock')->default(0);
    $table->enum('status', ['draft','active','archived'])->default('active');
    $table->text('description')->nullable();
    $table->softDeletes();
    $table->timestamps();

    // ② 外部キーを「任意の一意な名前」で明示的に付与
    $table->foreign('company_id', 'fk_products_company')
          ->references('id')->on('companies')
          ->cascadeOnDelete();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
