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
        Schema::create('user_detail', function (Blueprint $table) {
            $table->id();
            $table->string('username', 100)->nullable();
            $table->string('password',255)->nullable(); 
            $table->string('name', 90)->nullable();
            $table->string('email',60)->nullable();
            $table->string('mobile',20)->nullable();
            $table->string('address',255)->nullable();
            $table->string('pincode',10)->nullable();
            $table->text('pdf')->nullable();  
            $table->string('token',255)->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active'); 
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
