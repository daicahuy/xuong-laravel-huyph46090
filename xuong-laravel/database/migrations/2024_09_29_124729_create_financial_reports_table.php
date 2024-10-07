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
        Schema::create('financial_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('month');
            $table->unsignedInteger('year');
            $table->decimal('total_sales', 10);
            $table->decimal('total_expenses', 10);
            $table->decimal('profit_before_tax', 10);
            $table->decimal('tax_amount', 14);
            $table->decimal('profit_after_tax', 14);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_reports');
    }
};
