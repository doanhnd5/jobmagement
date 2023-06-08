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
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('post_title');
            $table->string('image_name');
            $table->text('post_content', 65535);
            $table->boolean('is_publish')->nullable();
            $table->timestamp('create_datetime')->nullable()->comment('Thời gian đăng post');
            $table->string('create_user', 256)->nullable()->comment('Người đăng post');
            $table->timestamp('update_datetime')->nullable()->comment('Thời gian sửa post');
            $table->string('update_user', 256)->nullable()->comment('Người sửa post');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
