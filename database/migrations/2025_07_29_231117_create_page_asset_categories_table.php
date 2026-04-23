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
        Schema::create('page_asset_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('groupTitle')->default('');
            $table->longText('description')->nullable();
            $table->integer('order')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('page_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('page_asset_categories');
    }
};
