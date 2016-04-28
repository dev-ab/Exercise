<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeMorphToOneAtt extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('attachments', function (Blueprint $table) {
            $table->dropColumn('owner_type');
            $table->dropColumn('owner_id');
            $table->integer('project_id')->unsigned()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('attachments', function (Blueprint $table) {
            $table->string('owner_type')->after('id');
            $table->integer('owner_id')->unsigned()->after('id');
            $table->dropColumn('project_id');
        });
    }

}
