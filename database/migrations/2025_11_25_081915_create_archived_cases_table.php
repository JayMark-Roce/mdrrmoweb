<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivedCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archived_cases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('case_num')->index();
            $table->json('case_snapshot');
            $table->foreignId('archived_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('archived_reason')->nullable();
            $table->timestamp('archived_at')->useCurrent();
            $table->timestamps();

            $table->unique('case_num');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archived_cases');
    }
}
