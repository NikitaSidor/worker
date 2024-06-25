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
        Schema::table('departments', function (Blueprint $table) {
            if (Schema::hasTable('employees') && Schema::hasColumn('departments', 'manager_id')) {
                $table->foreign('manager_id')
                    ->references('id')
                    ->on('employees')
                    ->onDelete('set null');
            }
        });

        Schema::table('job_titles', function (Blueprint $table) {
            if (Schema::hasTable('employees') && Schema::hasColumn('job_titles', 'supervisor')) {
                $table->foreign('supervisor')
                    ->references('id')
                    ->on('employees')
                    ->onDelete('set null');
            }
        });

        Schema::table('employees', function (Blueprint $table) {
            if (Schema::hasTable('users') && Schema::hasColumn('employees', 'employees_users_id')) {
                $table->foreign('employees_users_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('set null');
            }

            if (Schema::hasTable('job_titles') && Schema::hasColumn('employees', 'job_title_id')) {
                $table->foreign('job_title_id')
                    ->references('id')
                    ->on('job_titles')
                    ->onDelete('cascade');
            }

            if (Schema::hasTable('departments') && Schema::hasColumn('employees', 'departments_id')) {
                $table->foreign('departments_id')
                    ->references('id')
                    ->on('departments')
                    ->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departments', function (Blueprint $table) {
            if (Schema::hasColumn('departments', 'manager_id')) {
                $table->dropForeign(['manager_id']);
            }
        });

        Schema::table('job_titles', function (Blueprint $table) {
            if (Schema::hasColumn('job_titles', 'supervisor')) {
                $table->dropForeign(['supervisor']);
            }
        });

        Schema::table('employees', function (Blueprint $table) {
            if (Schema::hasColumn('employees', 'employees_users_id')) {
                $table->dropForeign(['employees_users_id']);
            }

            if (Schema::hasColumn('employees', 'job_title_id')) {
                $table->dropForeign(['job_title_id']);
            }

            if (Schema::hasColumn('employees', 'departments_id')) {
                $table->dropForeign(['departments_id']);
            }
        });
    }
};
