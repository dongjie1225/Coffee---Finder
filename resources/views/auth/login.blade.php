<x-guest-layout>
    <div class="card shadow">
        <div class="card-body p-4">
            <h2 class="card-title text-center mb-4">Login</h2>

            @if (session('status'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus 
                           autocomplete="username">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
        </div>

        <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" 
                           class="form-control @error('password') is-invalid @enderror"
                            type="password"
                            name="password"
                           required 
                           autocomplete="current-password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
        </div>

        <!-- Remember Me -->
                <div class="mb-3 form-check">
                    <input id="remember_me" 
                           type="checkbox" 
                           class="form-check-input" 
                           name="remember">
                    <label class="form-check-label" for="remember_me">
                        Remember me
            </label>
        </div>

                <div class="d-flex justify-content-between align-items-center">
            @if (Route::has('password.request'))
                        <a class="text-decoration-none" href="{{ route('password.request') }}">
                            Forgot your password?
                </a>
            @endif

                    <button type="submit" class="btn btn-primary">
                        Log in
                    </button>
                </div>

                <div class="text-center mt-3">
                    <a href="{{ route('register') }}" class="text-decoration-none">
                        Don't have an account? Register here
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
