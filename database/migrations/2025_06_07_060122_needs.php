<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('needs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->string('title');
            // $table->string('category');
            $table->enum('category', [
                'logistik',
                'desain & media',
                'dokumentasi & administrasi',
                'konsumsi & sdm'
            ]);
            $table->string('description');
            $table->string('status')->default('draft'); // draft, submitted_to_ceo, approved_by_ceo, rejected_by_ceo, etc
            $table->text('approval_notes')->nullable();
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('needs');
    }
};