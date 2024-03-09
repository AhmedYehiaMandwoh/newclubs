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
        Schema::table('client_offers', function (Blueprint $table) {
            $table->foreignId('from_client_id')->nullable()->after('client_id')->constrained('clients');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_offers', function (Blueprint $table) {
            $table->dropConstrainedForeignId('from_client_id');
        });
    }
};
