<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceRecordsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('finance_records', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date');
            $table->string('name')
                ->unique();
            $table->string('type');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('description')->nullable();
            $table->integer('amount');
            $table->timestamp('effective_date');
            $table->timestamps();

            // Foreign keys
            $table->foreign('category_id')->references('id')->on('finance_categories')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('finance_records', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });

        Schema::dropIfExists('finance_records');
    }
}
