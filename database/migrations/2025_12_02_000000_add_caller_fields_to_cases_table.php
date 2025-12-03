<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cases', function (Blueprint $table) {
            $table->string('caller_name')->nullable()->after('contact');
            $table->string('caller_contact')->nullable()->after('caller_name');
        });

        DB::statement("ALTER TABLE `cases` MODIFY `name` VARCHAR(255) NULL");
        DB::statement("ALTER TABLE `cases` MODIFY `contact` VARCHAR(255) NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cases', function (Blueprint $table) {
            $table->dropColumn(['caller_name', 'caller_contact']);
        });

        DB::statement("ALTER TABLE `cases` MODIFY `name` VARCHAR(255) NOT NULL");
        DB::statement("ALTER TABLE `cases` MODIFY `contact` VARCHAR(255) NOT NULL");
    }
};

