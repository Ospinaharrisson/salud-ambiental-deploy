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
        Schema::create('chemical_item_stamps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chemical_item_id')->constrained('chemical_items')->onDelete('cascade');
            $table->foreignId('chemical_stamp_id')->constrained('chemical_stamps')->onDelete('cascade');
            $table->integer('order')->nullable();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('chemical_item_stamps');
    }
};
