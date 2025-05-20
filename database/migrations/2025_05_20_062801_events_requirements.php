<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('events_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->String('item');
            $table->enum('status', ['draft', 'submitted', 'approved', 'rejected'])->default('draft');
            $table->text('notes')->nullable(); //catatan feedback dari CEO
            $table->timestamps();
        });
    }

 
    public function down(): void
    {
        Schema::dropIfExists('events_requirements');
    }
};
