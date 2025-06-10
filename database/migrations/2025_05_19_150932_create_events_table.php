<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('date');
            $table->time('time');
            $table->enum('category', ['webinar','seminar','workshop','pelatihan','talkshow','lomba','bootcamp','kuliah_umum','diskusi','lainnya',])->default('lainnya');
            $table->string('venue');
            $table->integer('capacity');
            $table->string('speaker');
            $table->string('mc');
            $table->text('description')->nullable();
            $table->timestamp('event_date');
            $table->String('venue')->nullable();
            $table->integer('capacity')->nullable();
            $table->enum('status', ['draft', 'submitted', 'approved', 'rejected'])->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
