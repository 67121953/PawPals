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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id')->constrained('pets')->onDelete('cascade'); // เชื่อมกับ ID สัตว์เลี้ยง
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->text('address');
            $table->string('occupation')->nullable();
            $table->string('experience'); // yes/no
            $table->text('reason');
            $table->string('status')->default('pending'); // สถานะ เช่น pending, approved, rejected
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};