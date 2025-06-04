<?php

namespace App\Console\Commands;

use App\Mail\VacationRequestNotification;
use App\Models\User;
use App\Models\VacationRequest;
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
        $vacationRequest = VacationRequest::create([
            'user_id' => $user->id,
            'start_date' => Carbon::now()->addDays(5),
            'end_date' => Carbon::now()->addDays(10),
            'days_requested' => 5,
            'reason' => 'Test vacation request',
            'comments' => 'This is a test vacation request for email testing purposes.',
            'status' => 'pending',
        ]);

        // Enviar el email
        $admin = User::where('role_id', 1)->first();
        if ($admin) {
            //            Mail::to($admin->email)->send(new VacationRequestNotification($vacationRequest));
            //            $this->info('Email enviado correctamente a ' . $admin->email);
            Mail::to('mariaamartinezros@gmail.com')->send(new VacationRequestNotification($vacationRequest));
            $this->info('Email enviado correctamente a '.'mariaamartinezros@gmail.com');
        } else {
            $this->error('No se encontró ningún administrador en el sistema.');
        }
    }
}
