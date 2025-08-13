<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Todo-List</title>
    <link rel="icon" type="image/x-icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/0/02/Circle-icons-computer.svg/768px-Circle-icons-computer.svg.png" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body class="min-h-screen bg-blue-50">
    <div class="relative min-h-screen flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-2xl bg-white shadow-xl rounded-lg overflow-hidden animate-bounce-in">

            
            <div class="bg-blue-600 p-6">
                <h2 class="text-3xl font-bold text-white text-center flex items-center justify-center gap-3">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                    </svg>
                    ToDo-List-App
                </h2>
                <p class="text-blue-100 text-center mt-2 font-medium">Organize your tasks efficiently</p>
            </div>

            <div class="p-8">

                @php
                $tasks = isset($tasks) ? $tasks : collect();
                @endphp

              
                <form action="{{ route('tasks.store') }}" method="POST" class="mb-8 animate-fade-in">
                    @csrf
                    <div class="flex gap-4">
                        <div class="flex-1 relative">
                            <input type="text"
                                name="title"
                                class="w-full pl-12 pr-4 py-4 bg-gray-50 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-200 text-gray-700 placeholder-gray-400 font-medium transition-all"
                                placeholder="What needs to be done?"
                                required>
                            <svg class="w-5 h-5 text-gray-400 absolute left-4 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <button type="submit" class="px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Add Task
                        </button>
                    </div>
                </form>

               
                <div class="space-y-3">
                    @if($tasks->isNotEmpty())
                    @foreach($tasks as $task)
                    <div class="group bg-gray-50 hover:bg-white border-2 border-gray-100 hover:border-blue-200 rounded-lg p-4 hover:shadow-md animate-slide-up transition-all task-item"
                        data-delay="{{ $loop->index * 0.1 }}">
                        <div class="flex items-center justify-between">
                            <!-- Update Task (toggle complete) -->
                            <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="flex items-center flex-1">
                                @csrf
                                @method('PUT')
                                <div class="flex items-center gap-4">
                                    <input type="checkbox"
                                        onChange="this.form.submit()"
                                        {{ $task->is_completed ? 'checked' : '' }}
                                        class="w-5 h-5 text-blue-600 border-2 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 cursor-pointer">
                                    <span class="text-lg font-medium transition-all {{ $task->is_completed ? 'text-gray-400 line-through' : 'text-gray-700 group-hover:text-blue-700' }}">
                                        {{ $task->title }}
                                    </span>
                                </div>
                            </form>

                          
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="ml-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transform hover:scale-110 transition-all" title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="text-center py-12 animate-fade-in">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-500 mb-2">No tasks yet</h3>
                        <p class="text-gray-400">Add your first task above to get started!</p>
                    </div>
                    @endif
                </div>

                @php
                $totalTasks = $tasks->count();
                $completed = $tasks->where('is_completed', true)->count();
                $remaining = $totalTasks - $completed;
                $percentage = $totalTasks > 0 ? round(($completed / $totalTasks) * 100) : 0;
                $progressClass = 'progress-' . (floor($percentage / 10) * 10);
                @endphp

                @if($totalTasks > 0)
                <div class="mt-8 p-4 bg-blue-50 rounded-lg border border-blue-100">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-600 font-medium">
                            Total: {{ $totalTasks }} task{{ $totalTasks !== 1 ? 's' : '' }}
                        </span>
                        <span class="text-gray-600 font-medium">Completed: {{ $completed }}</span>
                        <span class="text-gray-600 font-medium">Remaining: {{ $remaining }}</span>
                    </div>
                    <div class="mt-3">
                        <div class="bg-gray-200 rounded-full h-2 overflow-hidden">
                            <div class="bg-blue-500 h-full rounded-full transition-all duration-500 {{ $progressClass }}">
                            </div>
                        </div>
                        <div class="mt-2 text-xs text-gray-500 text-right">{{ $percentage }}%</div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script src="{{ asset('js/index.js') }}"></script>
</body>

</html>