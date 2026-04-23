@push('styles')
  <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/user/Content/Bulletin/bulletin.css')}}" />
@endpush

<div class="bulletin my-4">
  @include('User.Content.Bulletin.Includes.Forecast.todayForecast')
  @include('User.Content.Bulletin.Includes.Calendar.forecastCalendar')
</div>