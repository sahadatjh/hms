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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hajji_id');
            $table->foreign('hajji_id')->references('id')->on('hajjis')->restrictOnDelete();
            $table->timestamp('payment_date');
            $table->string('payment_method');
            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('check_no')->nullable();
            $table->timestamp('issue_date')->nullable();
            $table->string('deposite_no')->nullable();
            $table->string('transaction_no')->nullable();
            $table->double('amount',8,2);
            $table->boolean('is_online_transfer')->default(false)->comment('0 for offline , 1 for online transfer');
            $table->text('remarks')->nullable();
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('payments');
    }
};
