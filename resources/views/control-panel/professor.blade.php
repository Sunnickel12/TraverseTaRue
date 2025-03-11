@extends('layouts.app')

@section('title', 'Professor Panel')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Professor Control Panel</h1>

    <h2 class="text-2xl mb-4">List of Students</h2>

    <ul class="list-disc pl-8">
        @foreach($students as $student)
            <li>{{ $student->name }} - {{ $student->email }} - {{ $student->class->name ?? 'No Class assigned' }}</li>
        @endforeach
    </ul>
@endsection
