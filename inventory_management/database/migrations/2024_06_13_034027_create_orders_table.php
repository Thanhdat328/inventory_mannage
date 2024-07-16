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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');     
            $table->timestamp('order_date');
            $table->timestamp('return_date')->nullable();
            $table->foreignId('receiver_id')->constrained()->onDelete('cascade');
            $table->boolean('delete_flag')->default(false);
            $table->foreignId('user_id_owner')->constrained()->onDelete('cascade');
            $table->string('status')->nullable()->defaultValue('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
