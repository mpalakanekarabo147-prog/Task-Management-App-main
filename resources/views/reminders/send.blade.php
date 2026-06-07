@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold mb-4">Send Deadline Reminders</h1>

    @if(session('status'))
        <div class="mb-4 text-green-700">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('reminders.deadlines') }}">
        @csrf
        <p class="mb-4">This will send deadline reminder emails to assignees who have reminders enabled and have tasks due in the next 2 days.</p>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Send Reminders</button>
    </form>
</div>
@endsection
