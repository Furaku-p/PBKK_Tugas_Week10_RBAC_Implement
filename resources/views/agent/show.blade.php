@extends('layouts.app')
@section('title', 'Agentic AI — '.$tema)
@section('body-class', $isDark ? 'dark-mode' : '')
@section('content')
<section class="inner container agent-page">
    <div class="mode-bar">
        <div class="eyebrow">AGENTIC AI / CONCEPT LAB</div>
        <div class="mode-links">
            <a href="{{ route('agent.show', ['tema' => $tema, 'mode' => 'light']) }}">Light</a>
            <a href="{{ route('agent.show', ['tema' => $tema, 'mode' => 'dark']) }}">Dark</a>
        </div>
    </div>

    @if(session('success'))
        <x-status-banner type="success" :message="session('success')" />
    @endif

    @if($errors->any())
        <x-status-banner type="error" message="Please check the form and try again." />
    @endif

    <div class="agent-title"><span class="orb"></span><div><div class="agent-kicker">MY PROJECT DIRECTION</div><h1>{{ $tema }}</h1></div></div>
    <p class="agent-lead">{{ $description }}</p>

    <div class="agent-flow">
        <span>UNDERSTAND</span><b>→</b><span>PLAN</span><b>→</b><span>EXECUTE</span><b>→</b><span>OBSERVE</span><b>→</b><span>ANALYZE</span><b>→</b><span>REPORT</span>
    </div>

    <div class="agent-grid">
        <div><span>01</span><h3>Skills</h3><p>Define what the investigation should accomplish, such as network reconnaissance, log analysis, or attack entry point analysis.</p></div>
        <div><span>02</span><h3>Agent</h3><p>The LLM acts as the reasoning and planning layer, adapting the investigation as new evidence is discovered.</p></div>
        <div><span>03</span><h3>Tools + MCP</h3><p>A unified tool registry connects native security tools, scripts, and external MCP-based services.</p></div>
        <div><span>04</span><h3>Policy</h3><p>The harness controls scope, permissions, risk, and whether an action can be executed.</p></div>
        <div><span>05</span><h3>Evidence</h3><p>Tool outputs become structured artifacts so findings can be traced back to the evidence that supports them.</p></div>
        <div><span>06</span><h3>Memory</h3><p>Investigation state, previous actions, and findings are maintained so the agent can continue its reasoning loop.</p></div>
    </div>

    <div class="agent-bottom">
        <div><span class="tiny-label">CORE PRINCIPLE</span><h2>The LLM decides <em>what</em> to investigate next.<br>The harness controls <em>how</em> it is executed.</h2></div>
        <div class="agent-buttons">
            <a class="button primary" href="{{ route('agent.show', ['tema' => 'Network Recon', 'mode' => $isDark ? 'dark' : 'light']) }}">Network Recon →</a>
            <a class="button ghost" href="{{ route('agent.show', ['tema' => 'Log Analysis', 'mode' => $isDark ? 'dark' : 'light']) }}">Log Analysis</a>
        </div>
    </div>

    <div class="idea-form-section">
        <div>
            <span class="tiny-label">04 — IDEA SUBMISSION</span>
            <h2>Have an idea?<br><em>Put it here.</em></h2>
            <p>Form ini menggunakan POST + CSRF dan validasi sederhana melalui PageController.</p>
        </div>
        <form class="idea-form" method="POST" action="{{ route('agent.submit') }}">
            @csrf
            <label for="name">NAME</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Your name" required>
            @error('name') <small>{{ $message }}</small> @enderror

            <label for="idea">YOUR IDEA</label>
            <textarea id="idea" name="idea" rows="6" placeholder="Describe your Agentic AI idea..." required>{{ old('idea') }}</textarea>
            @error('idea') <small>{{ $message }}</small> @enderror

            <button class="button primary" type="submit">Submit idea →</button>
        </form>
    </div>
</section>
@endsection
