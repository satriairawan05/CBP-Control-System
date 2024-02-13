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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable()->references('id')->on('projects')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('task_id')->nullable()->references('id')->on('tasks')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('code')->unique()->nullable();
            $table->string('doc_number')->unique()->nullable();
            $table->longText('message')->nullable();
            $table->string('status')->nullable();
            $table->string('image')->nullable();
            $table->decimal('price',16)->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('finish_by')->nullable();
            $table->timestamps();
            $table->index('project_id');
            $table->index('task_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
