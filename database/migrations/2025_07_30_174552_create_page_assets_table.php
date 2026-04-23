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
        Schema::create('page_assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['document', 'image', 'geo', 'link'])->nullable();
            $table->string('link')->nullable();
            $table->string('mime_type')->nullable();
            $table->longText('content_base64')->nullable();
            $table->integer('order')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('page_asset_category_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('page_assets');
    }
};
