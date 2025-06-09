<?php

namespace App\Console\Commands;

use App\Mail\VacationRequestNotification;
use App\Models\User;
use App\Models\VacationRequest as VacationRequestModel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestVacationRequestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-vacation-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the vacation request email with dummy data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Crear un usuario de prueba si no existe
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'role_id' => 2, // role_id 2 es empleado
            ]
        );

        // Crear una solicitud de vacaciones de prueba
        $vacationRequest = VacationRequestModel::create([
            'user_id' => $user->id,
            'start_date' => Carbon::now()->addDays(5),
            'end_date' => Carbon::now()->addDays(10),
            'comments' => __('This is a test vacation request for email testing purposes.'),
            'status' => 'pending',
        ]);

        // Enviar el email
        $admin = User::where('role_id', 1)->first();
        if ($admin) {
            Mail::to(config('app.admin_email'))->send(new VacationRequestNotification($vacationRequest, $user, $vacationRequest->totalDays()));
            $this->info(__('Vacation request email sent successfully'));
        } else {
            $this->error(__('Error sending email'));
        }
    }
}
