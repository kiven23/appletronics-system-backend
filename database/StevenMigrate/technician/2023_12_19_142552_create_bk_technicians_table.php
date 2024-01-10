<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBkTechniciansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bk_technicians', function (Blueprint $table) {
            $table->increments('id');
            $table->text('callid');
            $table->text('creator_id');
            $table->text('type');
            $table->text('status');
            $table->text('totech');
            $table->text('reason');
            $table->text('remarks');
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
        Schema::dropIfExists('bk_technicians');
    }
}
