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
        Schema::create('maintenance_records', function (Blueprint $table) {
    $table->id();
    $table->foreignId('equipment_id')->constrained()->cascadeOnDelete();
    $table->string('type'); // preventivo, correctivo, repotenciación
    $table->text('description');
    $table->date('date');
    $table->date('next_maintenance')->nullable();
    $table->foreignId('performed_by')->nullable()->constrained('personnels')->nullOnDelete();
    $table->decimal('cost', 10, 2)->nullable();
    $table->text('notes')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_records');
    }
};
