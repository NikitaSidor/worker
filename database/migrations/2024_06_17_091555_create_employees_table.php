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
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); // Автоинкрементирующийся первичный ключ
            $table->unsignedBigInteger('user_id'); // Правильное имя столбца для внешнего ключа пользователя
            $table->unsignedBigInteger('job_title_id'); // Правильное имя столбца для внешнего ключа должности
            $table->unsignedBigInteger('department_id'); // Правильное имя столбца для внешнего ключа департамента
            $table->decimal('salary', 10, 2);
            $table->string('currency', 255)->default('RUB');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('job_title_id')->references('id')->on('job_titles')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
