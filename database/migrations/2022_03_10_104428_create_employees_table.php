<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('employees')) {
            Schema::create('employees', function (Blueprint $table) {
                $table->string('fname', 20);
                    $table->string('lname', 20);
                    $table->string('username', 20)->unique();
                    $table->string('email',50)->unique();
                    $table->string('fullname', 100);
                    $table->string('initial', 30);
                    $table->string('address', 200);
                    $table->string('phone', 80);
                    $table->string('post', 20);
                    $table->string('image', 300);
                    $table->integer('faculty_id');
                    $table->unsignedBigInteger('department_id');
                    $table->timestamps();

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
        Schema::dropIfExists('employees');
    }
}
