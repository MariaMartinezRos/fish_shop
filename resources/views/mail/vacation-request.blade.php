@component('mail::message')
# Nueva Solicitud de Vacaciones

Hola,

El empleado {{ $employee->name }} ha solicitado vacaciones.

**Detalles de la solicitud:**

- **Empleado:** {{ $employee->name }}
- **Fecha de inicio:** {{ $vacationRequest->start_date->format('d/m/Y') }}
- **Fecha de fin:** {{ $vacationRequest->end_date->format('d/m/Y') }}
- **Días solicitados:** {{ $days_requested }}
- **Motivo:** {{ $vacationRequest->comments }}

@component('mail::button', ['url' => route('users.index')])
Ver Solicitud
@endcomponent

Por favor, revisa esta solicitud y toma la acción correspondiente.

Saludos,<br>
{{ config('app.name') }}
@endcomponent 