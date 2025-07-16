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
            $defaultWelcome = 'Hello!
I am {{$user->name}}, a therapist.

I am unable to give you a appointment for now, please subscribe to this waiting list and I will be sure get in touch when I have time for you.';
            $table->text('welcoming_message')->default($defaultWelcome);


            $defaultConfirmation = 'Very well, {{$subscription->name}}!

I take good note that your
phone number is {{$subscription->name}}, I will to contact you whenever I have the time you offer you an appointment.

If you have given me your email, a confirmation email has been sent to your inbox.

There is nothing more to do for you, I wish you a pleasant day.';
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
