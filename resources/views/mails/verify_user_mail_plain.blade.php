@lang('mail.verify-dear') {{$user['name']}}!

@lang('mail.verify-message-1')

{{$user['email']}}

@lang('mail.verify-message-4')
{{ url(trans('auth.verify-link'), $user->verifyUser->token) }}

@lang('mail.regards') 
@lang('mail.sign') 

@lang('index.site-name') 
@lang('index.slogen')