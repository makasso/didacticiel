@component('mail::message')
    Salut, <b>{{ $user->name}}</b> votre compte a été créé sur <b>{{ config('app.name') }}</b> avec succès, félicitations. <br>
    Votre mot de passe est <b>{{ $password }}</b>. Nous vous recommandons de le modifier une fois connecté. 
@endcomponent