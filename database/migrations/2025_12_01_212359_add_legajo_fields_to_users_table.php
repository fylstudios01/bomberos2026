<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLegajoFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name')->nullable();
            $table->string('dni')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('legajo_number')->nullable();
            $table->date('ingreso_date')->nullable();

            // FK jerarquía
            $table->unsignedBigInteger('hierarchy_id')->nullable();
            $table->foreign('hierarchy_id')->references('id')->on('hierarchies')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'last_name',
                'dni',
                'phone',
                'address',
                'birthdate',
                'legajo_number',
                'ingreso_date',
            ]);

            $table->dropForeign(['hierarchy_id']);
            $table->dropColumn('hierarchy_id');
        });
    }
}
