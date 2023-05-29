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
        Schema::create('job_tag', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('job_id')->comment('Job');
            $table->bigInteger('tag_id')->comment('Tag');
            $table->timestamp('create_datetime')->nullable()->comment('Thời gian');
            $table->string('create_user', 256)->nullable()->comment('Người');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_tag');
    }
};
