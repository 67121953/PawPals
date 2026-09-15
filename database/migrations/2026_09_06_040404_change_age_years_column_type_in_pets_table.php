<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pets', function (Blueprint $table) {
            // เปลี่ยนชนิดข้อมูลเป็น decimal เพื่อรองรับทศนิยม เช่น 0.50
            $table->decimal('age_years', 5, 2)->change();
        });
    }

    public function down(): void
    {
        Schema::table('pets', function (Blueprint $table) {
            $table->integer('age_years')->change();
        });
    }
};