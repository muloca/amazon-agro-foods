<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            if (! Schema::hasColumn('news', 'title_translations')) {
                $table->json('title_translations')->nullable()->after('title');
            }

            if (! Schema::hasColumn('news', 'summary_translations')) {
                $table->json('summary_translations')->nullable()->after('summary');
            }

            if (! Schema::hasColumn('news', 'content_translations')) {
                $table->json('content_translations')->nullable()->after('content');
            }
        });
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            if (Schema::hasColumn('news', 'title_translations')) {
                $table->dropColumn('title_translations');
            }
            if (Schema::hasColumn('news', 'summary_translations')) {
                $table->dropColumn('summary_translations');
            }
            if (Schema::hasColumn('news', 'content_translations')) {
                $table->dropColumn('content_translations');
            }
        });
    }
};
