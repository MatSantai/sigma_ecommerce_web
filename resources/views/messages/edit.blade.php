@extends('layouts.app')

@section('title', 'Edit Message')

@section('content')
<div class="bg-gray-900 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <a href="{{ route('admin.messages.show', $message) }}" class="inline-flex items-center text-blue-400 hover:text-blue-300 mb-2">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Message
                    </a>
                    <h1 class="text-3xl font-bold text-white">Edit Message</h1>
                    <p class="mt-2 text-gray-400">Update your team message</p>
                </div>
                <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-700 shadow-sm text-sm font-medium rounded-md text-gray-300 bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-list mr-2"></i>
                    All Messages
                </a>
            </div>
        </div>

        <!-- Edit Message Form -->
        <div class="bg-gray-800 shadow-xl rounded-lg overflow-hidden">
            <div class="px-6 py-6">
                <form action="{{ route('admin.messages.update', $message) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Title Field -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-300 mb-2">
                            Message Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               value="{{ old('title', $message->title) }}"
                               class="block w-full border-gray-700 bg-gray-900 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-4 py-3"
                               placeholder="Enter message title..."
                               required>
                        @error('title')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Priority Field -->
                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-300 mb-2">
                            Priority <span class="text-red-500">*</span>
                        </label>
                        <select name="priority" 
                                id="priority"
                                class="block w-full border-gray-700 bg-gray-900 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-4 py-3"
                                required>
                            <option value="low" {{ old('priority', $message->priority) === 'low' ? 'selected' : '' }}>
                                Low - General information
                            </option>
                            <option value="medium" {{ old('priority', $message->priority) === 'medium' ? 'selected' : '' }}>
                                Medium - Important notice
                            </option>
                            <option value="high" {{ old('priority', $message->priority) === 'high' ? 'selected' : '' }}>
                                High - Urgent/Important
                            </option>
                        </select>
                        @error('priority')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content Field -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-300 mb-2">
                            Message Content <span class="text-red-500">*</span>
                        </label>
                        <textarea name="content" 
                                  id="content" 
                                  rows="8"
                                  class="block w-full border-gray-700 bg-gray-900 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-4 py-3"
                                  placeholder="Write your message here..."
                                  required>{{ old('content', $message->content) }}</textarea>
                        <p class="mt-2 text-sm text-gray-400">Maximum 5000 characters</p>
                        @error('content')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Message Info -->
                    <div class="bg-gray-900 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-gray-300 mb-3">Message Information:</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-400">Original Author:</span>
                                <span class="text-white ml-2">{{ $message->user->name }}</span>
                            </div>
                            <div>
                                <span class="text-gray-400">Created:</span>
                                <span class="text-white ml-2">{{ $message->created_at->format('F j, Y \a\t g:i A') }}</span>
                            </div>
                            <div>
                                <span class="text-gray-400">Last Updated:</span>
                                <span class="text-white ml-2">{{ $message->updated_at->format('F j, Y \a\t g:i A') }}</span>
                            </div>
                            <div>
                                <span class="text-gray-400">Status:</span>
                                <span class="text-white ml-2">
                                    @if($message->is_pinned)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-thumbtack mr-1"></i>
                                            Pinned
                                        </span>
                                    @else
                                        <span class="text-gray-300">Normal</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-4 pt-6">
                        <a href="{{ route('admin.messages.show', $message) }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-700 shadow-sm text-sm font-medium rounded-md text-gray-300 bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <i class="fas fa-save mr-2"></i>
                            Update Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 