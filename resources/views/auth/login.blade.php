@extends('layouts.auth')

@section('title', 'Login — Clinic MR')

@section('content')
<main class="auth-page">
    <div class="auth-card">
        <div class="brand">Clinic MR</div>
        <h1>Sign in to your account</h1>

        @if($errors->any())
            <div class="error-box">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ url('/login') }}" class="auth-form">
            @csrf

            <label class="field">
                <span>Email</span>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus>
            </label>

            <label class="field">
                <span>Password</span>
                <div class="pw-wrap">
                    <input type="password" name="password" required>
                    <button type="button" class="pw-toggle" aria-label="Toggle password">👁️</button>
                </div>
            </label>

            <label class="checkbox">
                <input type="checkbox" name="remember"> Remember me
            </label>

            <button class="btn-primary" type="submit">Sign in</button>
        </form>

        <p class="muted">Need an account? Please contact admin.</p>
    </div>
</main>
@endsection

