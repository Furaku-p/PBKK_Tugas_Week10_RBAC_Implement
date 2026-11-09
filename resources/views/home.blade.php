@extends('layouts.app')
@section('title', 'Alfianz — Student Profile')
@section('content')
@if($user)
<section class="container welcome-wrap"><x-status-banner type="success" :message="'Selamat datang, ' . $user . '!'" /></section>
@endif
<section class="hero container">
    <div class="hero-copy">
        <div class="eyebrow"><span class="pulse"></span> Institut Teknologi Sepuluh Nopember</div>
        <h1>Building ideas<br><em>into something real.</em></h1>
        <p class="hero-text">Selamat datang. Ini adalah ruang kecil untuk mengenal perjalanan akademik, minat, dan ide Agentic AI saya.</p>
        <div class="hero-actions">
            <a class="button primary" href="{{ route('mahasiswa.show', ['nrp' => $mahasiswa['nrp']]) }}">Explore profile <span>→</span></a>
            <a class="button ghost" href="{{ route('agent.show') }}">My AI concept</a>
        </div>
    </div>
    <div class="hero-card">
        <div class="card-top"><span>STUDENT / 01</span><span>2026</span></div>
        <div class="avatar">A</div>
        <h2>{{ $mahasiswa['name'] }}</h2>
        <p>{{ $mahasiswa['program'] }} · {{ $mahasiswa['faculty'] }}</p>
        <div class="mini-line"></div>
        <div class="card-bottom"><span>NRP</span><strong>{{ $mahasiswa['nrp'] }}</strong></div>
    </div>
</section>

<section class="container section-grid">
    <div class="section-label">01 — About</div>
    <div class="about-copy">
        <h2>Curious by default.<br>Intentional by design.</h2>
        <p>{{ $mahasiswa['bio'] }}</p>
        <div class="chips">
            @foreach($mahasiswa['interests'] as $interest)<span>{{ $interest }}</span>@endforeach
        </div>
    </div>
</section>

<section class="container academic-section">
    <x-info-card label="CURRENT GPA" title="Academic Snapshot" :value="number_format($ipk, 2) . ' / 4.00'" />
    <div class="section-label">02 — Academic</div>
    <div class="academic-main">
        <div class="ipk-card">
            <div class="ipk-meta"><span>CURRENT GPA / IPK</span><span>4.00 SCALE</span></div>
            <div class="ipk-number">{{ number_format($ipk, 2) }}</div>
            <div class="ipk-track"><span></span></div>
            <div class="ipk-foot"><span>IP 1: {{ number_format($ip1, 2) }} · IP 2: {{ number_format($ip2, 2) }}</span><a href="{{ route('ipk.calculate', ['ip1' => $ip1, 'ip2' => $ip2]) }}"><strong>Calculate →</strong></a></div>
        </div>
        <div class="academic-copy">
            <span class="tiny-label">ACADEMIC SNAPSHOT</span>
            <h2>Learning, building,<br>then building again.</h2>
            <p>Perjalanan akademik di Teknik Informatika ITS dengan fokus pada teknologi web, AI, dan eksplorasi sistem yang dapat menyelesaikan masalah nyata.</p>
            <a class="text-link" href="{{ route('mahasiswa.show', ['nrp' => $mahasiswa['nrp']]) }}">View full profile →</a>
        </div>
    </div>
</section>

<section class="container feature-grid">
    <a class="feature feature-dark" href="{{ route('agent.show') }}">
        <span class="feature-no">03</span><span class="feature-arrow">↗</span>
        <p>AGENTIC AI</p><h3>Security<br>that can reason.</h3>
        <span class="feature-link">Explore the concept</span>
    </a>
    <a class="feature" href="{{ route('mahasiswa.show', ['nrp' => $mahasiswa['nrp']]) }}">
        <span class="feature-no">04</span><span class="feature-arrow">↗</span>
        <p>ACADEMIC PROFILE</p><h3>A little more<br>about me.</h3>
        <span class="feature-link">View profile</span>
    </a>
</section>
@endsection
