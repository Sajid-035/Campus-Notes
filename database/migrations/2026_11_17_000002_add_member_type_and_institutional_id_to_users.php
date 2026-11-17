<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('account_type', 20)->default('student')->after('student_id')->index();
            $table->string('institutional_id_number', 80)->nullable()->after('account_type');
            $table->unique(['institution_name', 'institutional_id_number'], 'users_institutional_id_unique');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_institutional_id_unique');
            $table->dropIndex(['account_type']);
            $table->dropColumn(['account_type', 'institutional_id_number']);
        });
    }
};
