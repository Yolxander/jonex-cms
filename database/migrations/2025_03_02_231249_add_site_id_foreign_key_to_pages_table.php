<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            // Add site_id column first (if it doesn't exist)
            if (!Schema::hasColumn('pages', 'site_id')) {
                $table->foreignId('site_id')->after('id')->constrained()->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            // Drop the foreign key constraint first, then the column
            $table->dropForeign(['site_id']);
            $table->dropColumn('site_id');
        });
    }
};
