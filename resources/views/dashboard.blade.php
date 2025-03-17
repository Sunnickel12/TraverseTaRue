@extends('layouts.app')

@section('title', 'User Lobby')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h1 class="text-4xl font-bold mb-4 text-center">Welcome, {{ auth()->user()->name }}!</h1>
            <p class="text-lg text-center mb-6">You are successfully logged in.</p>
            <form action="{{ route('logout') }}" method="POST" class="text-center mb-4">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</button>
            </form>
            <a href="{{ route('lobby') }}" class="text-blue-500 hover:underline">Back to Lobby</a>
        </div>
    </div>
@endsection
