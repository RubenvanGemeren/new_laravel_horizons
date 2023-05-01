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
        Schema::create('finance_records', function (Blueprint $table) {
            $table->id();
            
            $table->timestamp('date');
            $table->string('name');
            $table->string('type');
            $table->string('category');
            $table->string('description')
                ->nullable();
            $table->integer('amount');
            $table->timestamp('effective_date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_records');
    }
};
