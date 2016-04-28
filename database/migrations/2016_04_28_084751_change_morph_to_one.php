<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeMorphToOne extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('owner_type');
            $table->dropColumn('owner_id');
            $table->integer('user_id')->unsigned()->after('id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('owner_type');
            $table->integer('owner_id')->unsigned();
            $table->dropColumn('user_id');
            
        });
    }

}
