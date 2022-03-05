<?php

use App\Models\City;
use App\Models\Specialite;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(City::class)->constrained();
            $table->foreignIdFor(Specialite::class)->constrained();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('mobile');
            $table->enum('gender',['M','F']);
            $table->string('work_id');
            $table->enum('degree',['master','doctors']);
            $table->date('birth_date');
            $table->string('password');
            $table->string('email');
            $table->string('cv');
            $table->string('avater')->default(asset('assets/img/1.jpg'));
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
