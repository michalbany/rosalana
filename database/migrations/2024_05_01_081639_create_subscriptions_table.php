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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\User::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(App\Models\UserSubscriptionPlan::class)->constrained()->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            /**
             * upravit tuto tabulku podle toho, co bude potřeba
             * Ta logika je zatím jenom návrh
             * */ 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
