<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Lidi co mají přístup k sbírce pokud je invite_only
     */
    public function up(): void
    {
        Schema::create('collection_contributors', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Collection::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(App\Models\User::class)->constrained()->onDelete('cascade');
            $table->string('status'); // 'pending' or 'accepted' or 'declined'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_contributors');
    }
};
