@extends('layouts.app')
@section('title', '404 — Not Found')
@section('content')
<section class="inner container error-page"><span class="error-code">404</span><h1>That route<br><em>doesn't exist.</em></h1><p>The page you're looking for couldn't be found.</p><a class="button primary" href="{{ route('home') }}">Back home →</a></section>
@endsection
