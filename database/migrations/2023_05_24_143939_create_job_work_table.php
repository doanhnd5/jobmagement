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
        Schema::create('job_work', function (Blueprint $table) {
            $table->id();
            $table->string('job_name')->comment('Tên Job');
            $table->string('employment_type_id')->comment('Hình thức tuyển dụng');
            $table->string('company_name')->comment('Tên công ty');
            $table->integer('salary')->comment('Mức lương cơ bản');
            $table->string('work_time_from')->comment('Thời gian bắt đầu làm việc');
            $table->string('work_time_to')->comment('Thời gian kết thúc làm việc');
            $table->string('workplace_prefecture')->comment('Khu vực');
            $table->string('workplace_city')->comment('Thành phố');
            $table->text('description')->nullable()->comment('Nội dung công việc');
            $table->string('image_name')->nullable()->comment('Ảhh đại diện công việc');
            $table->boolean('is_important')->comment('Ảhh đại diện công việc');
            $table->timestamp('create_datetime')->nullable()->comment('Thời gian đăng job');
            $table->string('create_user', 256)->nullable()->comment('Người đăng job');
            $table->timestamp('update_datetime')->nullable()->comment('Thời gian sửa job');
            $table->string('update_user', 256)->nullable()->comment('Người sửa job');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_work');
    }
};
