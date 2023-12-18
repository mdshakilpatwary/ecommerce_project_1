@component('mail::message');
<p>Hello {{$user['name']}} </p>
<p>{{$user->remember_token}} </p>
@component('mail::button',['url'=> url('reset_password',$user->remember_token)])
    Reset your password
@endcomponent

<p>Incase you have you have anyissues recovering your password, please contact us.</p>

Thanks <br>
{{config('app.name')}}

@endcomponent