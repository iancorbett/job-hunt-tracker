<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            if (!Schema::hasColumn('applications', 'user_id')) {
                $table->foreignId('user_id')->after('id')->constrained()->cascadeOnDelete();
            }
            if (!Schema::hasColumn('applications', 'company_id')) {
                $table->foreignId('company_id')->after('user_id')->constrained()->cascadeOnDelete();
            }
            if (!Schema::hasColumn('applications', 'role')) {
                $table->string('role')->after('company_id');
            }
            if (!Schema::hasColumn('applications', 'status')) {
                $table->enum('status', ['Saved','Applied','Interview','Offer','Rejected'])
                      ->default('Saved')
                      ->after('role');
            }
            if (!Schema::hasColumn('applications', 'salary_min')) {
                $table->integer('salary_min')->nullable()->after('status');
            }
            if (!Schema::hasColumn('applications', 'salary_max')) {
                $table->integer('salary_max')->nullable()->after('salary_min');
            }
            if (!Schema::hasColumn('applications', 'applied_at')) {
                $table->date('applied_at')->nullable()->after('salary_max');
            }
            if (!Schema::hasColumn('applications', 'notes')) {
                $table->text('notes')->nullable()->after('applied_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            if (Schema::hasColumn('applications', 'notes'))       $table->dropColumn('notes');
            if (Schema::hasColumn('applications', 'applied_at'))  $table->dropColumn('applied_at');
            if (Schema::hasColumn('applications', 'salary_max'))  $table->dropColumn('salary_max');
            if (Schema::hasColumn('applications', 'salary_min'))  $table->dropColumn('salary_min');
            if (Schema::hasColumn('applications', 'status'))      $table->dropColumn('status');
            if (Schema::hasColumn('applications', 'role'))        $table->dropColumn('role');
            if (Schema::hasColumn('applications', 'company_id'))  $table->dropConstrainedForeignId('company_id');
            if (Schema::hasColumn('applications', 'user_id'))     $table->dropConstrainedForeignId('user_id');
        });
    }
};
