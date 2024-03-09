@component('mail::message')
    # @lang('base.reset_your_password_link')
    @component('mail::button', ['url' => route('HospitalityProviders.reset-password') .'?token=' . $data['token']])
        @lang('base.click_here_to_change_your_password')
    @endcomponent
@endcomponent
