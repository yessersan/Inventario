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
       Schema::create('equipment', function (Blueprint $table) {
    $table->id();
    $table->string('code')->unique();
    $table->string('name');
    $table->string('type'); // computadora, laptop, impresora...
    $table->string('brand')->nullable();
    $table->string('model')->nullable();
    $table->string('serial_number')->unique()->nullable();
    $table->string('status')->default('activo'); // activo, en_mantenimiento, dado_de_baja
    $table->foreignId('location_id')->nullable()->constrained()->nullOnDelete();
    $table->foreignId('responsible_id')->nullable()->constrained('personnels')->nullOnDelete();
    $table->date('entry_date');
    $table->date('warranty_end')->nullable();
    $table->text('notes')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
