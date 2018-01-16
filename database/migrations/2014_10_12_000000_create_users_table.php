<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 32)->unique(); //agregado por separado
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email', 64)->unique();
            $table->string('password');
            $table->string('imageurl')->nullable();
            $table->integer('rol_id')->unsigned(); //agregado por separado, llave foranea
            $table->rememberToken();
            $table->timestamps();


            //Relacion a tabla rols campo id
            $table->foreign('rol_id')->references('id')->on('rols')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
