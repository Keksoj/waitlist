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
        Schema::table('users', function (Blueprint $table) {
            $defaultWelcome = 'Hello! I am unable to give you a appointment for now, please subscribe.';
            $table->text('welcoming_message')->default($defaultWelcome);


            $defaultConfirmation = 'Very well, I will to contact you when I have time';
            $table->text('confirmation_message')->default($defaultConfirmation);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('welcoming_message');
            $table->dropColumn('confirmation_message');
        });
    }
};
