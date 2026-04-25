@extends('layout')

@section('title', 'Register - EComm Store')

@section('content')
<div class="container" style="padding: 60px 0;">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div style="text-align: center; margin-bottom: 40px;">
                <h1 style="font-size: 32px; font-weight: 800; color: #1f2937; margin-bottom: 8px;">Join EComm</h1>
                <p style="color: #6b7280;">Create an account to start shopping today</p>
            </div>

            <div class="card" style="border: 1px solid #e5e7eb; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.08);">
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('register.submit') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" placeholder="John Doe" required>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" placeholder="your@email.com" required>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" placeholder="••••••••" required>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" 
                                   id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100" style="font-weight: 600;">
                            Create Account
                        </button>
                    </form>

                    <hr style="margin: 32px 0; border: none; border-top: 1px solid #e5e7eb;">

                    <p style="text-align: center; color: #6b7280; margin: 0;">
                        Already have an account? 
                        <a href="{{ route('login') }}" style="color: #6366f1; text-decoration: none; font-weight: 600;">Sign in</a>
                    </p>
                </div>
            </div>

            <p style="text-align: center; color: #9ca3af; font-size: 13px; margin-top: 24px;">
                <i class="fas fa-lock"></i> Your password is encrypted and secure
            </p>
        </div>
    </div>
</div>
@endsection
        </div>
    </div>
</div>
@endsection
