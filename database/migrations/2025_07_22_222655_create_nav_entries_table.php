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
        Schema::create('nav_entries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('link')->nullable();
            $table->string('mime_type')->nullable();
            $table->longText('content_base64')->nullable();
            $table->integer('order')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('nav_collection_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('nav_entries');
    }
};
