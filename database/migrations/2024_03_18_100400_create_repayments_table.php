<?php

use App\Models\Loan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('repayments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Loan::class)->constrained()->onDelete('cascade');
            $table->decimal('remaining_amount', 10, 2);
            $table->decimal('emi', 10, 2);
            // $table->integer('total_emi_paid');
            $table->integer('emi_remaining');
            $table->date('payment_date');
            $table->date('due_date');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repayments');
    }
};
