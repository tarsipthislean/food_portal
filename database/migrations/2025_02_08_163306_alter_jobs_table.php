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
        Schema::table('jobs', function (Blueprint $table) {
            $table->integer('status')->default(1)->after('job_image');  // เพิ่ม status หลัง job_image
            $table->integer('isFeatured')->default(0)->after('status'); // เพิ่ม isFeatured หลัง status
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // ลบคอลัมน์ที่เพิ่มเข้ามาหากต้องการย้อนกลับ
        Schema::table('jobs', function (Blueprint $table) {
            // $table->dropColumn('status');
            // $table->dropColumn('isFeatured');
        });
    }
};
