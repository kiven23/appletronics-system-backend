<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBkRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bk_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('requestid');
            $table->string('requesttype');
            $table->string('customerid');
            $table->string('branch');
            $table->string('userid');
            $table->string('unitid');
            $table->string('attachment');
            $table->string('additionalrequest1');
            $table->string('additionalrequest2');
            $table->string('specialinstruction');
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
        Schema::dropIfExists('bk_requests');
    }
}
