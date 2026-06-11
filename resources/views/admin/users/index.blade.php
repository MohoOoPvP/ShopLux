@extends('layouts.admin')
@section('title', 'Users & Roles')
@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-users"></i> Users & Role Management</h2>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add User</a>
    </div>
    <table>
        <thead>
            <tr><th>Name</th><th>Email</th><th>Role</th><th>Joined</th><th>Quick Role Change</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>
                    <div style="display:flex;align-items:center;gap:10px">
                        <div style="width:36px;height:36px;background:#e94560;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700">{{ strtoupper(substr($user->name,0,1)) }}</div>
                        <span>{{ $user->name }}</span>
                    </div>
                </td>
                <td>{{ $user->email }}</td>
                <td>
                    <span class="badge {{ $user->role === 'admin' ? 'badge-danger' : 'badge-info' }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </td>
                <td>{{ $user->created_at->format('M d, Y') }}</td>
                <td>
                    @if($user->id !== auth()->id())
                    <form method="POST" action="{{ route('admin.users.role', $user) }}" style="display:inline">
                        @csrf @method('PATCH')
                        <select name="role" class="form-control" style="width:auto;display:inline;padding:.3rem .6rem;font-size:.8rem" onchange="this.form.submit()">
                            <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer</option>
                            <option value="admin"    {{ $user->role === 'admin'    ? 'selected' : '' }}>Admin</option>
                        </select>
                    </form>
                    @else
                        <span style="color:#999;font-size:.8rem">(You)</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                    @if($user->id !== auth()->id())
                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display:inline" onsubmit="return confirm('Delete user?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="card-body">{{ $users->links() }}</div>
</div>
@endsection
