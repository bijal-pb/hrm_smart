<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyIdToProjectEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_employees', function (Blueprint $table) {
            $table->unsignedInteger('company_id')->nullable();
			$table->foreign('company_id')
			      ->references('id')->on('companies')
			      ->onUpdate('cascade')
			      ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_employees', function (Blueprint $table) {
            $table->dropColumn('company_id');
        });
    }
}
