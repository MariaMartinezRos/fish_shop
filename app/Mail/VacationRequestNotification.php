<?php

namespace App\Mail;

use App\Models\VacationRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VacationRequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $vacationRequest;

    private $days_requested;

    public $employee;

    /**
     * Create a new message instance.
     */
    public function __construct(VacationRequest $vacationRequest, $employee, $days_requested)
    {
        $this->vacationRequest = $vacationRequest;
        $this->employee = $employee;
        $this->days_requested = $days_requested;

        \Log::info('VacationRequestNotification constructed', [
            'vacation_request_id' => $vacationRequest->id,
            'employee_id' => $employee->id,
            'days_requested' => $days_requested,
        ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('New Vacation Request - PESCADERIAS BENITO'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        \Log::info('Preparing email content', [
            'vacation_request_id' => $this->vacationRequest->id,
            'employee_name' => $this->employee->name,
        ]);

        return new Content(
            markdown: 'emails.vacation-request',
            with: [
                'vacationRequest' => $this->vacationRequest,
                'employee' => $this->employee,
                'days_requested' => $this->days_requested,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
