<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBkCustomerHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bk_customer_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('middlename');
            $table->string('barangay');
            $table->string('contactperson');
            $table->string('cpnumber');
            $table->string('emailaddress');
            $table->string('houseno');
            $table->string('mcity');
            $table->string('organization');
            $table->string('province');
            $table->string('specialinstruction');
            $table->string('street');
            $table->string('telephoneno');
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
        Schema::dropIfExists('bk_customer_histories');
    }
}
