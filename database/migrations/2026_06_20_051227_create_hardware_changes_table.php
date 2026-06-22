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
       Schema::create('hardware_changes', function (Blueprint $table) {
    $table->id();
    $table->foreignId('equipment_id')->constrained()->cascadeOnDelete();
    $table->string('change_type'); // modificacion, reemplazo, repotenciación
    $table->text('description');
    $table->date('date');
    $table->foreignId('responsible_id')->nullable()->constrained('personnels')->nullOnDelete();
    $table->foreignId('old_component_id')->nullable()->constrained('components')->nullOnDelete();
    $table->foreignId('new_component_id')->nullable()->constrained('components')->nullOnDelete();
    $table->text('notes')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hardware_changes');
    }
};
