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
        Schema::table('forms', function (Blueprint $table) {
            $table->string('template_type')->after('sid');
            $table->string('font_type')->after('template_type');
            $table->string('paper_size')->after('font_type');
            $table->string('page_type')->after('paper_size');
            $table->string('background_image')->nullable()->after('page_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('forms', function (Blueprint $table) {
            $table->dropColumn('template_type');
            $table->dropColumn('font_type');
            $table->dropColumn('paper_size');
            $table->dropColumn('page_type');
        });
    }
};
