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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('job_id')->comment('Job ứng tuyển');
            $table->string('first_name')->comment('Họ');
            $table->string('last_name')->comment('Tên');
            $table->string('date_of_birth')->comment('Ngày tháng năm sinh');
            $table->string('gender')->comment('Giới tính');
            $table->string('email')->comment('Email');
            $table->string('phone_number')->comment('Số điện thoại');
            $table->string('facebook_url')->comment('Facebook');
            $table->string('address')->comment('Địa chỉ');
            $table->boolean('is_contacted')->comment('Đã liên hệ / Chưa liên hệ');
            $table->string('japanese_skill_id')->comment('Trình độ tiếng Nhật');
            $table->string('residence')->comment('Tư cách lưu trú');
            $table->timestamp('apply_date')->nullable()->comment('Thời gian ứng tuyển');
            $table->timestamp('update_datetime')->nullable()->comment('Thời gian update');
            $table->string('update_user', 256)->nullable()->comment('Người update');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
