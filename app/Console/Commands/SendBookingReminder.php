<?php

namespace App\Console\Commands;

use App\Mail\ReservationReminder;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendBookingReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:booking-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a reminder email for upcoming bookings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reservations = Reservation::whereDate('res_date', Carbon::now()->addDay())->get();

        foreach ($reservations as $reservation) {
            Mail::to($reservation->email)->send(new ReservationReminder($reservation));
        }
    }
}
