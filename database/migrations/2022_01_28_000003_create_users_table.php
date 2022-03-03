<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->integer('faculty_id');
                $table->string('name', 100);
                $table->string('username', 20)->unique();
                $table->string('email', 100)->unique();
                $table->string('password');
                $table->string('remark')->nullable();
                $table->boolean('active')->default(false);
                $table->boolean('is_admin')->default(false);
                $table->timestamp('email_verified_at')->nullable();
                $table->rememberToken();
                $table->timestamps();
                $table->string('lastOnline', 20)->nullable();

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
        Schema::dropIfExists('users');
    }
}
