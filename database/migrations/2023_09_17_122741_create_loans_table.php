<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loan_type_id');
            $table->unsignedBigInteger('approved_by_id')->nullable();
            $table->foreign('loan_type_id')->references('id')->on('loan_types');
            $table->foreign('approved_by_id')->references('id')->on('users');
            $table->float('amount', 10, 2);
            $table->dateTime('date_applied');
            $table->dateTime('date_approved')->nullable();
            $table->dateTime('date_released')->nullable();
            $table->text('reason')->nullable();
            $table->text('remarks')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
