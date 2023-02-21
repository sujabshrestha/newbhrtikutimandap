@component('mail::message')
{{-- @section('mailLogo')
<a href="{{ route('frontend.home') }}" >
    <img src="{{ getOriginalUrl(returnSiteSetting('logo')) ?? '' }}" style="width: 120px;" alt="Egp Nepal Logo">
</a>
@endsection --}}

@component('mail::panel')
    Change Your Password Of <a href='{{ env('APP_URL') }}' > {{ returnSiteSetting('title') ?? 'Venue Booking System'}} </a>
    <br>
@endcomponent

@component('mail::table')
|                                 |                            |
| ------------------              |:-------------------------: |
| <strong>Name:</strong>           | {{ $details['name'] }}     |
| <strong>Email:</strong>          | {{ $details['email'] }}    |

@endcomponent

@component('mail::button', ['url' => env('APP_URL').'/vendor/resetpassword/'.$details['email'].'/'.$details['token'],'color' => 'success'])
Change Password
@endcomponent


Thanks,<br>
{{ returnSiteSetting('title') ?? 'Venue Booking System' }}


@endcomponent
