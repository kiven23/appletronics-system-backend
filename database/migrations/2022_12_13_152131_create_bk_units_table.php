<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBkUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bk_units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('appliancetype');
            $table->string('area');
            $table->string('brand');
            $table->string('datepurchase');
            $table->string('deliverydate');
            $table->string('demandreplacement');
            $table->string('level');
            $table->string('location');
            $table->string('locationofinstallation');
            $table->string('model');

            $table->string('paidamoun');
            $table->string('priority');
            $table->string('prodcategories');
            $table->string('propertytype');
            $table->string('qty');
            $table->string('serialno');
            $table->string('time');
            $table->string('unitcondition');
            $table->string('wallfinish');
            $table->string('warrantycondition');
            $table->string('withpowersupply');
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
        Schema::dropIfExists('bk_units');
    }
}
