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
        Schema::create('hajjis', function (Blueprint $table) {
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
            $table->foreignId('agent_id')->nullable();
            $table->foreign('agent_id')->references('id')->on('agents');
            $table->string('district')->nullable();
            $table->string('gender');
            $table->foreignId('package_id')->nullable();
            $table->foreign('package_id')->references('id')->on('packages');
            $table->double('discount',8,2)->default(0);
            $table->boolean('is_percent')->default(0)->comment('0 for flate discount, 1 for percent discount');
            $table->string('address');
            $table->text('remarks')->nullable();
            $table->string('photo')->nullable();
            $table->string('pid')->nullable();
            $table->string('passport_no')->nullable();
            $table->string('passport_image')->nullable();
            $table->string('visa_number')->nullable();
            $table->string('visa_image')->nullable();
            $table->integer('status')->default(1)->comment('1 for pre registration, 2 for runnig, 3 for archive, 4 for cancel');
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
        Schema::dropIfExists('hajjis');
    }
};
