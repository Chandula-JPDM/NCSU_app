<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerifiedDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('verified_data')) {
            Schema::create('verified_data', function (Blueprint $table) {
                $table->id();
                $table->string('fname', 20);
                $table->string('lname', 20);
                $table->string('username', 20)->unique();
                $table->string('fullname', 100);
                $table->string('initial', 50);
                $table->string('address', 100);
                $table->string('city', 100);
                $table->string('date', 20);
                $table->string('regNo', 10)->unique();
                $table->string('image', 200);
                $table->integer('faculty_id');
                $table->integer('batch_id');
                $table->unsignedBigInteger('department_id');
                $table->timestamps();

                $table->foreign('batch_id')->references('id')->on('batches');
                $table->foreign('department_id')->references('id')->on('departments');
                $table->foreign('faculty_id')->references('id')->on('faculties');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verified_data');
    }
}
