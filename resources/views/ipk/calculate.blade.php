@extends('layouts.app')

@section('title', 'Hitung IPK')

@section('content')
<section class="ipk-page container">
    <div class="ipk-page-head">
        <div>
            <div class="eyebrow">ACADEMIC TOOL / 02</div>
            <h1>Hitung <em>IPK.</em></h1>
            <p>Masukkan nilai IP dari dua semester untuk melihat rata-rata IPK kamu dalam skala 4.00.</p>
        </div>
        <a class="button ghost" href="{{ route('home') }}">← Back home</a>
    </div>

    <div class="ipk-result-layout">
        <div class="ipk-result-card">
            <div class="ipk-result-top">
                <span>GPA / IPK RESULT</span>
                <span>4.00 SCALE</span>
            </div>

            @isset($ipk)
                <div class="ipk-result-number">{{ number_format($ipk, 2) }}</div>
                <div class="ipk-result-track">
                    <span style="width: {{ min(100, max(0, ($ipk / 4) * 100)) }}%"></span>
                </div>
                <div class="ipk-foot">
                    <span>AVERAGE OF TWO SEMESTERS</span>
                    <strong>{{ number_format(($ipk / 4) * 100, 0) }}%</strong>
                </div>
            @else
                <div class="ipk-empty">
                    <span class="ipk-empty-mark">—</span>
                    <h2>Your IPK<br>will appear here.</h2>
                    <p>Isi dua nilai semester di panel sebelah untuk menghitung hasilnya.</p>
                </div>
            @endisset
        </div>

        <div class="ipk-breakdown">
            <div class="ipk-breakdown-title">CALCULATION / INPUT</div>

            <form id="ipkForm" class="ipk-form">
                <div class="ip-row ip-input-row">
                    <label for="ip1">IP SEMESTER 1</label>
                    <input id="ip1" name="ip1" type="number" min="0" max="4" step="0.01"
                        value="{{ isset($ip1) ? number_format($ip1, 2, '.', '') : '' }}"
                        placeholder="3.70" required>
                </div>

                <div class="ip-symbol">+</div>

                <div class="ip-row ip-input-row">
                    <label for="ip2">IP SEMESTER 2</label>
                    <input id="ip2" name="ip2" type="number" min="0" max="4" step="0.01"
                        value="{{ isset($ip2) ? number_format($ip2, 2, '.', '') : '' }}"
                        placeholder="3.80" required>
                </div>

                <div class="formula">IPK = (IP 1 + IP 2) ÷ 2</div>

                <button type="submit" class="button primary ipk-submit">
                    Calculate IPK <span>→</span>
                </button>
            </form>
        </div>
    </div>

    @isset($ipk)
        <div class="ipk-actions">
            <span>RESULT / {{ number_format($ip1, 2) }} + {{ number_format($ip2, 2) }} ÷ 2</span>
            <a class="text-link" href="{{ route('ipk.form') }}">Reset calculation →</a>
        </div>
    @endisset
</section>

<script>
    document.getElementById('ipkForm').addEventListener('submit', function (event) {
        event.preventDefault();

        const ip1 = parseFloat(document.getElementById('ip1').value);
        const ip2 = parseFloat(document.getElementById('ip2').value);

        if (!Number.isFinite(ip1) || !Number.isFinite(ip2) || ip1 < 0 || ip1 > 4 || ip2 < 0 || ip2 > 4) {
            return;
        }

        window.location.href = `{{ url('/hitung-ipk') }}/${ip1}/${ip2}`;
    });
</script>
@endsection
