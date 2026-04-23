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
        Schema::create('chemical_item_details', function (Blueprint $table) {
            $table->id();
            $table->string('value', 200);
            $table->enum('type', ['danger', 'economy'])->default('danger');
            $table->integer('order')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('chemical_item_id')->constrained('chemical_items')->onDelete('cascade');
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
        Schema::dropIfExists('chemical_item_details');
    }
};
