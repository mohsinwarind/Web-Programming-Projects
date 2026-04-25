@extends('admin.layout')

@section('admin-content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h1 style="color: #333; margin: 0;">
        <i class="fas fa-envelope"></i> Message Details
    </h1>
    <a href="{{ route('admin.contacts') }}" class="btn btn-outline-secondary">Back to Messages</a>
</div>

<div class="row">
    <div class="col-md-8">
        <!-- Original Message -->
        <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); margin-bottom: 20px;">
            <h4 style="color: #333; margin-bottom: 20px;">Original Message</h4>
            
            <div style="margin-bottom: 15px;">
                <p style="margin: 0; color: #999; font-size: 14px;">FROM</p>
                <p style="margin: 0; font-weight: 500;">{{ $contact->user->name }} ({{ $contact->email }})</p>
            </div>

            <div style="margin-bottom: 15px;">
                <p style="margin: 0; color: #999; font-size: 14px;">SUBJECT</p>
                <p style="margin: 0; font-weight: 500;">{{ $contact->subject }}</p>
            </div>

            <div style="margin-bottom: 15px;">
                <p style="margin: 0; color: #999; font-size: 14px;">DATE</p>
                <p style="margin: 0; font-weight: 500;">{{ $contact->created_at->format('F d, Y H:i') }}</p>
            </div>

            <hr style="margin: 20px 0;">

            <div>
                <p style="margin: 0; color: #999; font-size: 14px;">MESSAGE</p>
                <p style="margin: 10px 0; line-height: 1.6;">{{ $contact->message }}</p>
            </div>
        </div>

        <!-- Replies Section -->
        <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); margin-bottom: 20px;">
            <h4 style="color: #333; margin-bottom: 20px;">
                <i class="fas fa-comments"></i> Replies ({{ $contact->replies->count() }})
            </h4>

            @if($contact->replies->count() > 0)
                <div style="margin-bottom: 20px;">
                    @foreach($contact->replies as $reply)
                        <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 15px; border-left: 4px solid #667eea;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                <strong style="color: #333;">{{ $reply->admin->name }} (Admin)</strong>
                                <small style="color: #999;">{{ $reply->created_at->format('M d, Y H:i') }}</small>
                            </div>
                            <p style="margin: 0; line-height: 1.6; color: #555;">{{ $reply->message }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="padding: 20px; text-align: center; color: #999;">
                    No replies yet.
                </div>
            @endif
        </div>

        <!-- Reply Form -->
        <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
            <h4 style="color: #333; margin-bottom: 20px;">Send a Reply</h4>

            <form method="POST" action="{{ route('admin.contact.reply', $contact->id) }}">
                @csrf
                <div class="mb-3">
                    <label for="message" class="form-label">Your Reply</label>
                    <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" placeholder="Type your reply here..." required></textarea>
                    @error('message')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                    <i class="fas fa-paper-plane"></i> Send Reply
                </button>
                <a href="{{ route('admin.contacts') }}" class="btn btn-outline-secondary">Cancel</a>
            </form>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-md-4">
        <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
            <h5 style="color: #333; margin-bottom: 20px;">Contact Information</h5>

            <div style="margin-bottom: 20px;">
                <small style="color: #999; display: block; margin-bottom: 5px;">NAME</small>
                <p style="margin: 0; font-weight: 500;">{{ $contact->name }}</p>
            </div>

            <div style="margin-bottom: 20px;">
                <small style="color: #999; display: block; margin-bottom: 5px;">EMAIL</small>
                <a href="mailto:{{ $contact->email }}" style="color: #667eea; text-decoration: none;">{{ $contact->email }}</a>
            </div>

            <div style="margin-bottom: 20px;">
                <small style="color: #999; display: block; margin-bottom: 5px;">USER ACCOUNT</small>
                <a href="{{ route('admin.customer.detail', $contact->user->id) }}" style="color: #667eea; text-decoration: none;">{{ $contact->user->name }}</a>
            </div>

            <hr style="margin: 20px 0;">

            <div>
                <small style="color: #999; display: block; margin-bottom: 5px;">RECEIVED</small>
                <p style="margin: 0; font-size: 14px;">{{ $contact->created_at->format('F d, Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>

@endsection
