@can('admin-access')
    @extends('layouts.Admin.adminApp')

    @section('content')
        <div class="container">
            <h2>Seller Applications</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Applied At</th>
                        <th>Documents</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $application)
                        <tr>
                            <td>{{ $application->user->name }}</td>
                            <td>{{ $application->user->email }}</td>
                            <td>
                                <span class="badge 
                                            @if($application->status == 'pending') bg-warning 
                                            @elseif($application->status == 'approved') bg-success 
                                            @else bg-danger @endif">
                                    {{ ucfirst($application->status) }}
                                </span>
                            </td>
                            <td>{{ $application->created_at->format('M d, Y H:i') }}</td>

                            {{-- ✅ Documents preview --}}
                            <td>
                                @if($application->business_permit)
                                    <a href="{{ asset('storage/' . $application->business_permit) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $application->business_permit) }}" alt="Business Permit"
                                            class="img-thumbnail" style="max-width:100px;">
                                    </a>
                                @else
                                    <em>No permit uploaded</em>
                                @endif
                                <br>
                                @if($application->valid_id)
                                    <a href="{{ asset('storage/' . $application->valid_id) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $application->valid_id) }}" alt="Valid ID"
                                            class="img-thumbnail mt-2" style="max-width:100px;">
                                    </a>
                                @else
                                    <em>No ID uploaded</em>
                                @endif
                            </td>

                            <td>
                                @if($application->status == 'pending')
                                    {{-- Approve Button --}}
                                    <form action="{{ route('admin.admin.approve', $application->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                    </form>

                                    {{-- Reject Button --}}
                                    <form action="{{ route('admin.admin.reject', $application->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                    </form>
                                @else
                                    <em>No actions available</em>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No applications found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endsection
@endcan