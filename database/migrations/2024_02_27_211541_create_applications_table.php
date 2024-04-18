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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('semester_id');
            $table->string('id_number');
            $table->string('equivalent');
            $table->string('average');
            $table->string('grade');
            $table->date('registrar_date_approved')->nullable();
            $table->date('dean_date_approved')->nullable();
            $table->date('vp_date_approved')->nullable();
            
            //0 = pending registrar, 1 = pending dean, 2 = pending vp, 3 = approved, 4 = rejected
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
