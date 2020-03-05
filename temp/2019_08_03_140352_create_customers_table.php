<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('territory_id')->unsigned();
            $table->string('title');
            $table->string('address');
            $table->string('cellno');
            $table->string('officeno')->nullable();
            $table->string('faxno')->nullable();
            $table->string('email')->nullable();
            $table->string('ntn')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('territory_id')->references('id')->on('territories');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
