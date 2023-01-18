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
        if (!Schema::hasTable('takleef_list')) {

            Schema::create('takleef_list', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('employee_id');
                $table->String('date');
                $table->String('employee_in')->nullable();
                $table->String('employee_out')->nullable();
                $table->timestamps();
                $table->foreign('employee_id')->references('id')->on('employees');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('takleef_list');
    }
};