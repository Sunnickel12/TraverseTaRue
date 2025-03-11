<!DOCTYPE html>
<html lang="en">
<head>
    <title>Users List</title>
</head>
<body>
    <h1>Users</h1>

    <a href="{{ route('users.create') }}">Create New User</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <ul>
        @foreach($users as $user)
            <li>
                {{ $user->getFullNameAttribute() }} - {{ $user->email }}
                <a href="{{ route('users.show', $user) }}">View</a>
                <a href="{{ route('users.edit', $user) }}">Edit</a>
                <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
