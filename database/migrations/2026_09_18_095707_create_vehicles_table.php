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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('make');
            $table->string('model');
            $table->string('registration_number')->unique()->nullable();
            $table->string('vin')->unique();
            $table->date('manufactured_year')->nullable();
            $table->date('inspection_date')->nullable();
            $table->date('insurance_date')->nullable();
            $table->boolean('is_active')->default(false);
            $table->foreignId('employee_id')->nullable()->constrained()->onDelete('set null');
            $table->float('mileage', 10, 2)->nullable();
            $table->string('fuel_type')->nullable();
            $table->date('oil_change_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
