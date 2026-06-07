<x-app-layout title="Edit Task">
    <h1 class="h3 mb-3">Edit sales task</h1>
    <div class="card surface-card"><div class="card-body">
        <form method="POST" action="{{ route('tasks.update', $task) }}">
            @method('PUT')
            @include('tasks._form', ['buttonText' => 'Save changes'])
        </form>
    </div></div>
</x-app-layout>
