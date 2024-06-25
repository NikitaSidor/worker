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
            $table->enum('employment_under', ['1', '2'])->nullable();
            $table->string('currency', 255)->default('RUB');

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
