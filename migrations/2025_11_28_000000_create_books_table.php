<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title');
            $table->string('author');
            $table->string('slug')->unique()->nullable();
            $table->string('image')->nullable();
            $table->decimal('price', 8, 2)->default(0);
            $table->integer('stock')->default(1);
            $table->string('condition')->default('new'); // new / used
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
