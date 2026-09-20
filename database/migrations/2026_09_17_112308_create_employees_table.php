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
        Schema::create('employees', function (Blueprint $table) {
        $table->id();

        // powiązanie z userem
        $table->foreignId('user_id')->constrained()->onDelete('cascade');

        // dane pracownicze
        $table->string('job_role'); // kierowca, sprzątaczka, etc.
        $table->string('department'); // administracja, robotnicza, zarząd

        // status pracownika
        $table->boolean('active')->default(true);

        // daty
        $table->date('hired_at')->nullable();
        $table->date('terminated_at')->nullable();

        $table->unique('user_id'); // każdy user może być tylko jednym pracownikiem

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
