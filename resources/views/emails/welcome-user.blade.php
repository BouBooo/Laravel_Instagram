@component('mail::message')
# Bienvenue

Vous inscription sur Laragram a été effectué avec succès.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
