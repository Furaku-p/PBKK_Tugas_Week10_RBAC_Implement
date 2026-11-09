@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<section class="inner container"><div class="eyebrow">DASHBOARD / ACADEMIC</div><h1>Welcome back,<br><em>{{ $mahasiswa['name'] }}</em></h1><div class="dashboard-grid"><div class="dash-card"><span>PROGRAM</span><strong>{{ $mahasiswa['program'] }}</strong></div><div class="dash-card"><span>SEMESTER</span><strong>{{ $mahasiswa['semester'] }}</strong></div><div class="dash-card"><span>AI PROJECT</span><strong>Agentic AI</strong></div></div></section>
@endsection
