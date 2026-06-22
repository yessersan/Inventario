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
       Schema::create('peripherals', function (Blueprint $table) {
    $table->id();
    $table->string('code')->unique();
    $table->string('name');
    $table->string('type'); // teclado, ratón, monitor...
    $table->string('brand')->nullable();
    $table->string('model')->nullable();
    $table->string('serial_number')->unique()->nullable();
    $table->string('status')->default('disponible');
    $table->foreignId('location_id')->nullable()->constrained()->nullOnDelete();
    $table->foreignId('equipment_id')->nullable()->constrained()->nullOnDelete();
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
        Schema::dropIfExists('peripherals');
    }
};
