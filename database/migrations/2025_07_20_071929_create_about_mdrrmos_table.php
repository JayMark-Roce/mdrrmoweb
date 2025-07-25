<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('about_mdrrmos', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->string('image')->nullable();  // optional image
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('about_mdrrmos');
    }
};