<?php

use App\Models\Loan;
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
        Schema::create('emis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Loan::class);
            $table->integer('emi_number');
            $table->decimal('emi_amount', 10, 2);
            $table->date('due_date');
            $table->decimal('remaining_emi_balance', 10, 2)->default(0);
            $table->integer('remaining_emi');
            $table->string('payment_status')->default('pending');
            $table->date('billing_date')->nullable();
            // $table->foreign('loan_id')->references('id')->on('loans');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emis');
    }
};
