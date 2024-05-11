@component('mail::message')
    Salut, pour vous connecter sur <b>{{ config('app.name') }}</b> cliquer sur le lien si dessous.
    @component('mail::button', ['url' => $url]) 
        Cliquer pour vous connecter
    @endcomponent
@endcomponent