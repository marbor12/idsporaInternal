<?php
// filepath: database/migrations/2025_06_11_XXXXXX_add_need_id_to_tasks_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            if (!Schema::hasColumn('tasks', 'need_id')) {
                $table->unsignedBigInteger('need_id')->nullable()->after('assigned_to');
                $table->foreign('need_id')->references('id')->on('needs')->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            if (Schema::hasColumn('tasks', 'need_id')) {
                $table->dropForeign(['need_id']);
                $table->dropColumn('need_id');
            }
        });
    }
};