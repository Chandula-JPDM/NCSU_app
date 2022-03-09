<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('people')) {
            Schema::create('people', function (Blueprint $table) {
                $table->id();
                $table->string('fname', 20);
                $table->string('lname', 20);
                $table->string('username', 20)->unique();
                $table->string('email',50)->unique();
                $table->string('password')->default(Hash::make('user12345'));
                $table->string('fullname', 100);
                $table->string('initial', 30);
                $table->string('address', 200);
                $table->string('city', 80);
                $table->string('date', 20);
                $table->string('regNo', 10)->unique();
                $table->string('image', 300);
                $table->integer('faculty_id');
                $table->integer('batch_id');
                $table->unsignedBigInteger('department_id');
                $table->timestamps();
                $table->boolean('isRejected')->default(false);

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
        Schema::dropIfExists('people');
    }
}
