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
        Schema::table('chemical_stamps', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->text('path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chemical_stamps', function (Blueprint $table) {
            $table->dropColumn('path');
            $table->longText('image')->nullable();
        });
    }
};
