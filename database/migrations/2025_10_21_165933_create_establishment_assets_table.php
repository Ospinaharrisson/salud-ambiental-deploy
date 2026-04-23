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
        Schema::create('establishment_assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('category', ['accredited', 'favorable'])->default('accredited');
            $table->enum('type', ['document', 'image', 'geo', 'link'])->nullable();
            $table->string('link')->nullable();
            $table->string('mime_type')->nullable();
            $table->longText('content_base64')->nullable();
            $table->longText('description')->nullable();
            $table->integer('order')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('module_id')->constrained('modules')->onDelete('cascade');
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
        Schema::dropIfExists('establishment_assets');
    }
};
