@extends('layouts.app')

@section('title', 'View Contact Message')

@section('content')
<div class="bg-gray-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Contact Message</h1>
                    <p class="mt-2 text-sm text-gray-400">
                        View and manage customer inquiry details.
                    </p>
                </div>
                <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-700 shadow-sm text-sm font-medium rounded-md text-gray-300 bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Messages
                </a>
            </div>
        </div>

        <!-- Message Details -->
        <div class="bg-gray-800 shadow-xl rounded-lg overflow-hidden">
            <!-- Message Header -->
            <div class="px-6 py-4 border-b border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-12 w-12">
                            <div class="h-12 w-12 rounded-full bg-blue-600 flex items-center justify-center">
                                <span class="text-lg font-medium text-white">
                                    {{ strtoupper(substr($contact->name, 0, 2)) }}
                                </span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-xl font-semibold text-white">{{ $contact->name }}</h2>
                            <p class="text-gray-400">{{ $contact->email }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-400">{{ $contact->created_at->format('M d, Y \a\t H:i') }}</p>
                        @if($contact->status === 'unread')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Unread
                            </span>
                        @elseif($contact->status === 'read')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                Read
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Replied
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Message Content -->
            <div class="px-6 py-6">
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-white mb-2">Subject</h3>
                    <p class="text-gray-300">{{ $contact->subject }}</p>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-medium text-white mb-2">Message</h3>
                    <div class="bg-gray-900 rounded-lg p-4">
                        <p class="text-gray-300 whitespace-pre-wrap">{{ $contact->message }}</p>
                    </div>
                </div>

                <!-- Status Management -->
                <div class="border-t border-gray-700 pt-6 mb-6">
                    <h3 class="text-lg font-medium text-white mb-4">Update Status</h3>
                    <form action="{{ route('admin.contacts.update-status', $contact) }}" method="POST" class="flex items-center space-x-4">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="border-gray-700 bg-gray-900 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-4 py-2">
                            <option value="unread" {{ $contact->status === 'unread' ? 'selected' : '' }}>Unread</option>
                            <option value="read" {{ $contact->status === 'read' ? 'selected' : '' }}>Read</option>
                            <option value="replied" {{ $contact->status === 'replied' ? 'selected' : '' }}>Replied</option>
                        </select>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-save mr-2"></i>
                            Update Status
                        </button>
                    </form>
                </div>

                <!-- Actions -->
                <div class="border-t border-gray-700 pt-6 flex justify-between items-center">
                    <div class="flex space-x-4">
                        <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" class="inline-flex items-center px-4 py-2 border border-gray-700 shadow-sm text-sm font-medium rounded-md text-gray-300 bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-reply mr-2"></i>
                            Reply via Email
                        </a>
                    </div>
                    
                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="showDeleteDialog('{{ $contact->name }}')" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <i class="fas fa-trash mr-2"></i>
                            Delete Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Dialog -->
<div id="deleteDialog" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-gray-800 rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-700">
            <h3 class="text-lg font-medium text-white">Confirm Delete</h3>
        </div>
        
        <div class="px-6 py-4">
            <p class="text-gray-300 mb-4">
                Are you sure you want to delete the message from <span id="deleteContactName" class="font-medium text-white"></span>?
            </p>
            <p class="text-sm text-gray-400 mb-6">
                This action cannot be undone. The message will be permanently deleted.
            </p>
            
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="hideDeleteDialog()" class="px-4 py-2 text-sm font-medium text-gray-300 bg-gray-700 hover:bg-gray-600 rounded-md transition-colors duration-200">
                    Cancel
                </button>
                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-md transition-colors duration-200">
                        Delete Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function showDeleteDialog(contactName) {
        document.getElementById('deleteContactName').textContent = contactName;
        document.getElementById('deleteDialog').classList.remove('hidden');
    }
    
    function hideDeleteDialog() {
        document.getElementById('deleteDialog').classList.add('hidden');
    }
    
    // Close dialog when clicking outside
    document.getElementById('deleteDialog').addEventListener('click', function(e) {
        if (e.target === this) {
            hideDeleteDialog();
        }
    });
    
    // Close dialog with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hideDeleteDialog();
        }
    });
</script>

@endsection 