<?php
// filepath: database/migrations/xxxx_xx_xx_xxxxxx_alter_assigned_to_nullable_on_tasks_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('assigned_to')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('assigned_to')->nullable(false)->change();
        });
    }
};