<x-mail::message>
# Hola, {{ $userName }}

Gracias por registrarte en Adler Reservas. Por favor, haz clic en el botón de abajo para verificar tu dirección de correo electrónico.

<x-mail::button :url="$verificationUrl">
Verificar Correo Electrónico
</x-mail::button>

Si no creaste una cuenta, no se requiere ninguna acción adicional.

Saludos,<br>
El equipo de {{ config('app.name') }}
</x-mail::message>