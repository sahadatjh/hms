<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('fathers_name')->nullable();
            $table->string('mothers_name')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('occupation')->nullable();
            $table->bigInteger('mobile');
            $table->string('nid',32)->nullable();
            $table->string('ng',32)->nullable();
            $table->string('tracking_number',32)->nullable();
            $table->date('dob');
            $table->foreignId('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts');
            $table->string('district')->nullable();
            $table->string('gender');
            $table->foreignId('package_id')->nullable();
            $table->foreign('package_id')->references('id')->on('packages');
            $table->string('address');
            $table->text('remarks')->nullable();
            $table->string('photo')->nullable();
            $table->string('pid')->nullable();
            $table->string('passport_no')->nullable();
            $table->string('passport_image')->nullable();
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
        Schema::dropIfExists('pre_registrations');
    }
};
