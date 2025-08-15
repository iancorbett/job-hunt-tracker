<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            if (!Schema::hasColumn('companies', 'user_id')) {
                $table->foreignId('user_id')->after('id')->constrained()->cascadeOnDelete();
            }
            if (!Schema::hasColumn('companies', 'name')) {
                $table->string('name')->after('user_id');
            }
            if (!Schema::hasColumn('companies', 'website')) {
                $table->string('website')->nullable()->after('name');
            }
            if (!Schema::hasColumn('companies', 'location')) {
                $table->string('location')->nullable()->after('website');
            }
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            if (Schema::hasColumn('companies', 'user_id'))  $table->dropConstrainedForeignId('user_id');
            if (Schema::hasColumn('companies', 'name'))     $table->dropColumn('name');
            if (Schema::hasColumn('companies', 'website'))  $table->dropColumn('website');
            if (Schema::hasColumn('companies', 'location')) $table->dropColumn('location');
        });
    }
};
