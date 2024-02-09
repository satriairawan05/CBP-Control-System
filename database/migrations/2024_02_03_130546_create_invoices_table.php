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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable()->references('id')->on('projects')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('code')->unique()->nullable();
            $table->foreignId('first')->nullable()->references('id')->on('users')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('second')->nullable()->references('id')->on('users')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('effective_date')->nullable();
            $table->date('expiration_date')->nullable();
            $table->string('account_number')->nullable();
            $table->string('payment')->nullable();
            $table->decimal('diskon',16)->nullable();
            $table->decimal('tax',16)->nullable();
            $table->decimal('amount',16)->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->index('project_id');
            $table->index('first');
            $table->index('second');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
