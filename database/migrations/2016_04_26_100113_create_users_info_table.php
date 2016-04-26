<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersInfoTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users_info', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('title', ['Mr.', 'Mrs.']);
            $table->string('fullname', 100);
            $table->string('job', 50);
            $table->date('birthdate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('users_info');
    }

}
