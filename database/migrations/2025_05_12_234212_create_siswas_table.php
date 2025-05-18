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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
             $table->string('nama',length:50);
            $table->string('nis',length:5)->unique;
            $table->enum('gender',['L','P'])->default('L');
            $table->text('alamat');
            $table->string('kontak',length:16);
            $table->string('email',length:30)->unique;
            $table->boolean('status_lapor_pkl')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};