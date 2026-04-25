@extends('layout')

@section('title', 'Contact Us')

@section('content')
<div class="container" style="margin-top: 30px; margin-bottom: 40px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border-radius: 15px;">
                <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 10px 10px 0 0; padding: 20px;">
                    <h3 style="margin: 0;">
                        <i class="fas fa-envelope"></i> Contact Us
                    </h3>
                </div>
                <div class="card-body p-5">
                    <p style="color: #666; margin-bottom: 30px;">
                        We'd love to hear from you! Please fill out the form below and we'll get back to you as soon as possible.
                    </p>

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('customer.contact.submit') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control form-control-lg @error('subject') is-invalid @enderror" 
                                   id="subject" name="subject" value="{{ old('subject') }}" required>
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                      id="message" name="message" rows="6" required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </button>
                    </form>

                    <hr style="margin: 30px 0;">

                    <div class="row text-center">
                        <div class="col-md-4">
                            <h6><i class="fas fa-envelope"></i> Email</h6>
                            <p><a href="mailto:support@ecomm.com" style="color: #667eea; text-decoration: none;">support@ecomm.com</a></p>
                        </div>
                        <div class="col-md-4">
                            <h6><i class="fas fa-phone"></i> Phone</h6>
                            <p><a href="tel:+923001234567" style="color: #667eea; text-decoration: none;">+92-300-1234567</a></p>
                        </div>
                        <div class="col-md-4">
                            <h6><i class="fas fa-map-marker-alt"></i> Location</h6>
                            <p>Karachi, Pakistan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
