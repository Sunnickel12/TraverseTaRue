@extends('layouts.app')

@section('title', 'Admin Panel')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Admin Control Panel</h1>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-4">Name</th>
                <th class="border p-4">Email</th>
                <th class="border p-4">Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="border p-4">{{ $user->name }}</td>
                    <td class="border p-4">{{ $user->email }}</td>
                    <td class="border p-4">
                        @if($user->id_role == 1) Admin
                        @elseif($user->id_role == 2) Professor
                        @else Student
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
