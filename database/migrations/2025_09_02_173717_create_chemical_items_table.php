<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chemical_items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('cas_number')->default('Desconocido');
            $table->string('onu_number')->default('Desconocido');
            $table->decimal('monthly_stored', 12, 2)->nullable();
            $table->decimal('monthly_used', 12, 2)->nullable();
            $table->decimal('score', 12, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('record_page_id')->constrained('records_pages')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chemical_items');
    }
};
