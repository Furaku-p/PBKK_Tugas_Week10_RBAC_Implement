<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Portal Akademik ITS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .login-page{min-height:100vh;display:grid;place-items:center;padding:32px 20px;background:var(--bg)}
        .login-card{width:min(100%,460px);padding:42px;background:#fff;border:1px solid var(--line);border-radius:24px;box-shadow:0 24px 70px #1717150d}
        .login-brand{display:flex;align-items:center;gap:10px;font-weight:700;letter-spacing:.04em;font-size:12px}
        .login-brand span{width:9px;height:9px;border-radius:50%;background:var(--accent)}
        .login-eyebrow{margin-top:34px;color:var(--muted);font-size:10px;letter-spacing:.15em;font-weight:700}
        .login-card h1{margin:12px 0;font:700 34px/1.05 ui-sans-serif,system-ui,sans-serif;letter-spacing:-.05em}
        .login-muted{color:var(--muted);font-size:14px;line-height:1.7}
        .login-card label{display:block;margin:20px 0 8px;font-size:12px;font-weight:700}
        .login-card input:not([type=checkbox]){width:100%;padding:13px 14px;border:1px solid var(--line);border-radius:10px;background:#fbfaf7;color:var(--ink);font:inherit}
        .login-card input:focus{outline:2px solid #d8ff4577;border-color:#9bad46}
        .login-card .remember{display:flex;align-items:center;gap:9px;font-size:12px;font-weight:500;margin-top:16px}
        .login-card button{width:100%;margin-top:22px;padding:14px;border:0;border-radius:999px;background:var(--ink);color:#fff;font:inherit;font-size:13px;font-weight:700;cursor:pointer}
        .login-card button:hover{opacity:.86}
        .login-error{margin-top:7px;color:#a52323;font-size:12px}
        .login-demo{margin-top:26px;padding-top:22px;border-top:1px solid var(--line)}
        .login-demo-actions{display:grid;grid-template-columns:1fr 1fr;gap:10px}
        .login-demo button{margin-top:10px;background:#eeece6;color:var(--ink)}
        .login-back{display:block;margin-top:25px;font-size:12px;color:var(--muted);text-decoration:none}
        .login-back:hover{color:var(--ink)}
        @media(max-width:520px){.login-card{padding:28px 22px}.login-card h1{font-size:29px}}
    </style>
</head>
<body>
    <main class="login-page">
        <section class="login-card">
            <div class="login-brand"><span></span> PORTAL AKADEMIK ITS</div>
            <div class="login-eyebrow">INSTITUT TEKNOLOGI SEPULUH NOPEMBER</div>
            <h1>Selamat datang kembali.</h1>
            <p class="login-muted">Masuk menggunakan akun Admin atau Staf untuk membuka dashboard akademik.</p>

            <form method="POST" action="{{ route('login.store') }}">
                @csrf
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email') <div class="login-error">{{ $message }}</div> @enderror

                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password">
                @error('password') <div class="login-error">{{ $message }}</div> @enderror

                <label class="remember"><input type="checkbox" name="remember"> Ingat saya</label>
                <button type="submit">Masuk ke Dashboard</button>
            </form>

            @if(app()->environment('local'))
                <div class="login-demo">
                    <strong>Demo akun lokal</strong>
                    <p class="login-muted" style="font-size:12px;margin:6px 0 8px">Pilih akun untuk mencoba perbedaan hak akses.</p>
                    <div class="login-demo-actions">
                        <form method="POST" action="{{ route('demo.login', 'admin') }}">@csrf<button type="submit">Login sebagai Admin</button></form>
                        <form method="POST" action="{{ route('demo.login', 'staf') }}">@csrf<button type="submit">Login sebagai Staf</button></form>
                    </div>
                </div>
            @endif
            <a class="login-back" href="{{ route('home') }}">← Kembali ke website publik</a>
        </section>
    </main>
</body>
</html>
