@component('mail::message')
    Salut, pour vous connecter sur {{ config('app.name') }} cliquer sur le lien si dessous

    @component('mail::button', ['url' => $url]) 
        Cliquer pour vous connecter
    @endcomponent
@endcomponent