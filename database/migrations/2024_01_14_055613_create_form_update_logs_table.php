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
        Schema::create('form_update_logs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('sid');
            $table->string('template_type');
            $table->string('font_type');
            $table->string('paper_size');
            $table->string('page_type');
            $table->string('background_image')->nullable();
            $table->float('image_transparacy')->nullable();
            $table->longText('content')->nullable();
            $table->integer('category')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('is_editable')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_update_logs');
    }
};
