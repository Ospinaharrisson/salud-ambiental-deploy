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
        Schema::create('records_pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name', 200);
            $table->longtext('image')->nullable();
            $table->longText('description');
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
        Schema::dropIfExists('records_pages');
    }
};
