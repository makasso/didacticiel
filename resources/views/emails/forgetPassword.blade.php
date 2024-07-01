@component('mail::message')
    Salut, pour réinitialiser votre mot de passe sur <b>{{ config('app.name') }}</b>, veuillez cliquer sur le lien ci-dessous.
    @component('mail::button', ['url' => route('reset.password.get', $token)])
        Cliquer pour réinitialiser
    @endcomponent
@endcomponent
