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
        Schema::create('vtu_platform', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("platform")->nullable();
            $table->decimal("purchaser_percentage", 20, 2)->default(0.00);
            $table->decimal("upline_percentage", 20, 2)->default(0.00);
            $table->integer("dwnl_gens")->default(0);
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
        Schema::dropIfExists('vtu_platform');
    }
};
