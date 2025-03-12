@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Welcome to Your Control Panel</h1>
    <p>Select your role below to proceed:</p>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Admin</h3>
                </div>
                <div class="card-body">
                    <p>Access the admin section to manage the system.</p>
                    <a href="{{ route('control.panel.admin') }}" class="btn btn-primary">Go to Admin Panel</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Professor</h3>
                </div>
                <div class="card-body">
                    <p>Access the professor section to manage courses and students.</p>
                    <a href="{{ route('control.panel.professor') }}" class="btn btn-primary">Go to Professor Panel</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Student</h3>
                </div>
                <div class="card-body">
                    <p>Access the student section to manage your profile and view courses.</p>
                    <a href="{{ route('control.panel.student') }}" class="btn btn-primary">Go to Student Panel</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
