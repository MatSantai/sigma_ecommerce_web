@extends('layouts.app')

@section('title', $message->title)

@section('content')
<div class="bg-gray-900 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center text-blue-400 hover:text-blue-300 mb-2">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Messages
                    </a>
                    <h1 class="text-3xl font-bold text-white">{{ $message->title }}</h1>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.messages.edit', $message) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <i class="fas fa-edit mr-2"></i>
                        Edit
                    </a>
                    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                onclick="return confirm('Are you sure you want to delete this message?')">
                            <i class="fas fa-trash mr-2"></i>
                            Delete
                        </button>
                    </form>
                    <form action="{{ route('admin.messages.toggle-pin', $message) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 {{ $message->is_pinned ? 'bg-yellow-600 hover:bg-yellow-700' : 'bg-gray-600 hover:bg-gray-700' }} border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">
                            <i class="fas fa-thumbtack mr-2"></i>
                            {{ $message->is_pinned ? 'Unpin' : 'Pin' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-900 border border-green-700 text-green-200 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Message Content -->
        <div class="bg-gray-800 shadow-xl rounded-lg overflow-hidden">
            <!-- Message Header -->
            <div class="px-6 py-4 border-b border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $message->priority_color }}">
                            <i class="{{ $message->priority_icon }} mr-1"></i>
                            {{ ucfirst($message->priority) }} Priority
                        </span>
                        @if($message->is_pinned)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-thumbtack mr-1"></i>
                                Pinned
                            </span>
                        @endif
                    </div>
                    <div class="text-sm text-gray-400">
                        Posted {{ $message->created_at->format('F j, Y \a\t g:i A') }}
                        @if($message->updated_at != $message->created_at)
                            <br><span class="text-xs">(Edited {{ $message->updated_at->format('F j, Y \a\t g:i A') }})</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Message Body -->
            <div class="px-6 py-6">
                <div class="prose prose-invert max-w-none">
                    <div class="whitespace-pre-wrap text-gray-300 leading-relaxed">
                        {{ $message->content }}
                    </div>
                </div>
            </div>

            <!-- Message Footer -->
            <div class="px-6 py-4 border-t border-gray-700 bg-gray-900">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                            <span class="text-sm font-medium text-white">{{ strtoupper(substr($message->user->name, 0, 2)) }}</span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-white">{{ $message->user->name }}</p>
                            <p class="text-xs text-gray-400">{{ $message->user->email }}</p>
                        </div>
                    </div>
                    <div class="text-sm text-gray-400">
                        Message ID: #{{ $message->id }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Priority Information -->
        <div class="mt-6 bg-gray-800 rounded-lg p-4">
            <h3 class="text-lg font-medium text-white mb-3">Priority Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex items-center p-3 bg-gray-700 rounded-lg">
                    <i class="fas fa-info-circle text-green-400 mr-3"></i>
                    <div>
                        <p class="text-sm font-medium text-white">Low Priority</p>
                        <p class="text-xs text-gray-400">General information</p>
                    </div>
                </div>
                <div class="flex items-center p-3 bg-gray-700 rounded-lg">
                    <i class="fas fa-exclamation-circle text-yellow-400 mr-3"></i>
                    <div>
                        <p class="text-sm font-medium text-white">Medium Priority</p>
                        <p class="text-xs text-gray-400">Important notices</p>
                    </div>
                </div>
                <div class="flex items-center p-3 bg-gray-700 rounded-lg">
                    <i class="fas fa-exclamation-triangle text-red-400 mr-3"></i>
                    <div>
                        <p class="text-sm font-medium text-white">High Priority</p>
                        <p class="text-xs text-gray-400">Urgent matters</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 