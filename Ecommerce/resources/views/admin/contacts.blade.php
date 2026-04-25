@extends('admin.layout')

@section('admin-content')
<h1 style="color: #333; margin-bottom: 30px;">
    <i class="fas fa-envelope"></i> Contact Messages
</h1>

<div style="background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
    @if($contacts->count() > 0)
        <div style="overflow-x: auto;">
            <table class="table table-hover" style="margin-bottom: 0;">
                <thead style="background: #f8f9fa;">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{ $contact->user->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>{{ $contact->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.contact.detail', $contact->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div style="padding: 20px; border-top: 1px solid #eee;">
            {{ $contacts->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div style="padding: 40px; text-align: center;">
            <p style="color: #999;">No messages found.</p>
        </div>
    @endif
</div>

@endsection
