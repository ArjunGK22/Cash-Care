<?php

use App\Models\Employee;
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
            $table->foreignIdFor(Employee::class);
            $table->decimal('loan_amount', 10, 2);
            $table->integer('repayment_period');
            $table->decimal('interest_rate', 5, 2);
            $table->decimal('total_payable', 10, 2)->nullable();
            $table->decimal('emi', 10, 2)->nullable();
            $table->string('status')->default('pending');
            $table->string('loan_type');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('disbursed_at')->nullable();
            $table->timestamps();
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
