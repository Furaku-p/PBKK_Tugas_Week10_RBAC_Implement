@extends('layouts.app')
@section('title', $profile['name'].' — Profile')
@section('content')
<section class="inner container">
    <div class="profile-head">
        <div><div class="eyebrow">STUDENT PROFILE / {{ $profile['nrp'] }}</div><h1>{{ $profile['name'] }}</h1><p>{{ $profile['program'] }} · {{ $profile['faculty'] }}</p></div>
        <div class="big-number">{{ str_pad((string) filter_var($profile['semester'], FILTER_SANITIZE_NUMBER_INT), 2, '0', STR_PAD_LEFT) }}</div>
    </div>
    <div class="profile-layout">
        <div>
            <div class="avatar large">A</div>
            <p class="lead">{{ $profile['bio'] }}</p>
            <div class="chips">@foreach($profile['interests'] as $interest)<span>{{ $interest }}</span>@endforeach</div>
        </div>
        <div class="data-card">
            <div><span>FULL NAME</span><strong>{{ $profile['name'] }}</strong></div>
            <div><span>NRP</span><strong>{{ $profile['nrp'] }}</strong></div>
            <div><span>PROGRAM</span><strong>{{ $profile['program'] }}</strong></div>
            <div><span>FACULTY</span><strong>{{ $profile['faculty'] }}</strong></div>
            <div><span>SEMESTER</span><strong>{{ $profile['semester'] }}</strong></div>
            <div class="profile-ipk"><span>IPK</span><strong>{{ $profile['ipk'] }} / 4.00</strong></div>
        </div>
    </div>
</section>
@endsection
