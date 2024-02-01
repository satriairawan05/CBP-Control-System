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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('code')->unique()->nullable();
            $table->text('summary')->nullable();
            $table->longText('description')->nullable();
            $table->date('deadline')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->string('size')->nullable();
            $table->string('flowchart')->nullable();
            $table->string('diagram')->nullable();
            $table->string('mockup')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('finish_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
