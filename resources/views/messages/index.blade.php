@extends('layouts.app')

@section('title', 'Admin Message Board')

@section('content')
<div class="bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-white">Admin Message Board</h1>
                    <p class="mt-2 text-gray-400">Manage team communications and announcements</p>
                </div>
                <a href="{{ route('admin.messages.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="fas fa-plus mr-2"></i>
                    New Message
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-900 border border-green-700 text-green-200 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Search Bar -->
        <div class="mb-6">
            <form action="{{ route('admin.messages.search') }}" method="GET" class="flex gap-4">
                <div class="flex-1">
                    <input type="text" name="q" value="{{ $query ?? '' }}" placeholder="Search messages..." 
                           class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <button type="submit" class="px-6 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <!-- Pinned Messages -->
        @if($pinnedMessages->count() > 0)
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-thumbtack text-yellow-400 mr-2"></i>
                    Pinned Messages
                </h2>
                <div class="space-y-4">
                    @foreach($pinnedMessages as $message)
                        <div class="bg-yellow-900/20 border border-yellow-700/50 rounded-lg p-6">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex items-center space-x-3">
                                    <h3 class="text-lg font-semibold text-white">{{ $message->title }}</h3>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $message->priority_color }}">
                                        <i class="{{ $message->priority_icon }} mr-1"></i>
                                        {{ ucfirst($message->priority) }}
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-thumbtack mr-1"></i>
                                        Pinned
                                    </span>
                                </div>
                                <div class="text-sm text-gray-400">
                                    {{ $message->created_at->diffForHumans() }}
                                </div>
                            </div>
                            <p class="text-gray-300 mb-4">{{ Str::limit($message->content, 200) }}</p>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-medium text-white">{{ strtoupper(substr($message->user->name, 0, 2)) }}</span>
                                    </div>
                                    <span class="text-sm text-gray-400">by {{ $message->user->name }}</span>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.messages.show', $message) }}" class="text-blue-400 hover:text-blue-300 text-sm">
                                        Read More
                                    </a>
                                    <form action="{{ route('admin.messages.toggle-pin', $message) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-yellow-400 hover:text-yellow-300 text-sm">
                                            Unpin
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- All Messages -->
        <div>
            <h2 class="text-xl font-semibold text-white mb-4">All Messages</h2>
            @if($messages->count() > 0)
                <div class="space-y-4">
                    @foreach($messages as $message)
                        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex items-center space-x-3">
                                    <h3 class="text-lg font-semibold text-white">{{ $message->title }}</h3>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $message->priority_color }}">
                                        <i class="{{ $message->priority_icon }} mr-1"></i>
                                        {{ ucfirst($message->priority) }}
                                    </span>
                                </div>
                                <div class="text-sm text-gray-400">
                                    {{ $message->created_at->diffForHumans() }}
                                </div>
                            </div>
                            <p class="text-gray-300 mb-4">{{ Str::limit($message->content, 200) }}</p>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-medium text-white">{{ strtoupper(substr($message->user->name, 0, 2)) }}</span>
                                    </div>
                                    <span class="text-sm text-gray-400">by {{ $message->user->name }}</span>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.messages.show', $message) }}" class="text-blue-400 hover:text-blue-300 text-sm">
                                        Read More
                                    </a>
                                    <a href="{{ route('admin.messages.edit', $message) }}" class="text-green-400 hover:text-green-300 text-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 text-sm" onclick="return confirm('Are you sure you want to delete this message?')">
                                            Delete
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.messages.toggle-pin', $message) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-yellow-400 hover:text-yellow-300 text-sm">
                                            {{ $message->is_pinned ? 'Unpin' : 'Pin' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $messages->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-comments text-gray-600 text-4xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-400 mb-2">No messages yet</h3>
                    <p class="text-gray-500">Be the first to post a message to the team!</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 