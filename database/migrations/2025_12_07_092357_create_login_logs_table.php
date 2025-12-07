<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_logs', function (Blueprint $table) {
            $table->id();
            $table->string('user_type'); // 'admin' or 'driver'
            $table->unsignedBigInteger('user_id')->nullable(); // ID of user or driver
            $table->string('email');
            $table->string('name')->nullable();
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('login_at');
            $table->boolean('success')->default(true);
            $table->text('failure_reason')->nullable();
            $table->timestamps();
            
            $table->index(['user_type', 'user_id']);
            $table->index('login_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login_logs');
    }
}
