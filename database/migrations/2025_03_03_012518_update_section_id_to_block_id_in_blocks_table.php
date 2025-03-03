<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('contents', function (Blueprint $table) {
            // Drop the foreign key first
            $table->dropForeign(['section_id']);

            // Rename column from section_id to block_id
            $table->renameColumn('section_id', 'block_id');

            // Re-add the foreign key constraint for block_id
            $table->foreign('block_id')->references('id')->on('sections')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('blocks', function (Blueprint $table) {
            // Drop the foreign key before renaming it back
            $table->dropForeign(['block_id']);

            // Rename block_id back to section_id
            $table->renameColumn('block_id', 'section_id');

            // Re-add the foreign key constraint for section_id
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
        });
    }
};
