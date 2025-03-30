@extends('layouts.navbar')

@section('title', 'Login')

@section('content')
    <div class="text-center text-2xl ">
        <h1>Login</h1>
        <br>
    </div>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="text-2xl ">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label>Email:</label>
            <input type="email" name="email" required value="{{ old('email') }}">
            <br>

            <label>Password:</label>
            <input type="password" name="password" required>
            <br>
            <div class="text-left">
                <button type="submit" style="background-color: #4CAF50; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer;">Login</button>
            </div>
        </form>
    </div>
    <a href="{{ route('home') }}" >Back to Lobby</a>
@endsection