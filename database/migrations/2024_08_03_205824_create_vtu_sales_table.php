<?php

use App\Functions\UsefulFunctions;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vtu_sales', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('service');
            $table->string('network');

            $functions = new UsefulFunctions();
            $date1 = "Aug 2024";
            $date2 = "Aug 2040";
            $dates = $functions->outPutMonthsBetweenTwoDates($date1, $date2);

            for($i = 0; $i < count($dates); $i++){
                $table->decimal(strtolower(str_replace(' ', '_', $dates[$i])), 20, 2)->default(0.00);
            }
            // $table->decimal('aug_2024', 20, 2)->default(0.00);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vtu_sales');
    }
};
