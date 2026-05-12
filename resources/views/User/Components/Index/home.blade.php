@extends('User.Components.Layout.layout')
@section('title','Inicio')

@push('styles')
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/user/Components/Icons/icon-effects.css')}}" />
@endpush

@section('content')
    @include('User.Content.MainCarousel.carousel')
    @include('User.Content.Bulletin.todayForecastCalendar')
    @include('User.Content.News.news')
    @include('User.Content.Galleries.gallery')
    @include('User.Content.Information.page-info')
    @include('User.Content.content-media.content')
@endsection