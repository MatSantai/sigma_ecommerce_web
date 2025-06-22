@extends('layouts.app')

@section('title', 'Contact Messages')

@section('content')
<div class="bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Contact Messages</h1>
                <p class="mt-2 text-sm text-gray-400">
                    Manage customer inquiries and support requests.
                </p>
            </div>
        </div>

        <!-- Stats -->
        <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-3">
            <div class="bg-gray-800 overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-envelope text-blue-400 text-2xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-400 truncate">Total Messages</dt>
                                <dd class="text-lg font-medium text-white">{{ $contacts->total() }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gray-800 overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-envelope-open text-yellow-400 text-2xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-400 truncate">Unread Messages</dt>
                                <dd class="text-lg font-medium text-white">{{ $unreadCount }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gray-800 overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-reply text-green-400 text-2xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-400 truncate">Replied</dt>
                                <dd class="text-lg font-medium text-white">{{ $contacts->where('status', 'replied')->count() }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Messages Table -->
        <div class="mt-8 flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border border-gray-700 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead class="bg-gray-800">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Customer
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Subject
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700 bg-gray-900">
                                @forelse($contacts as $contact)
                                <tr class="{{ $contact->status === 'unread' ? 'bg-gray-800' : '' }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-blue-600 flex items-center justify-center">
                                                    <span class="text-sm font-medium text-white">
                                                        {{ strtoupper(substr($contact->name, 0, 2)) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-white">{{ $contact->name }}</div>
                                                <div class="text-sm text-gray-400">{{ $contact->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-white">{{ $contact->subject }}</div>
                                        <div class="text-sm text-gray-400">
                                            {{ Str::limit($contact->message, 50) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
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
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                        {{ $contact->created_at->format('M d, Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('admin.contacts.show', $contact) }}" class="text-blue-400 hover:text-blue-300 mr-3">
                                            View
                                        </a>
                                        <button type="button" onclick="showDeleteDialog({{ $contact->id }}, '{{ $contact->name }}')" class="text-red-400 hover:text-red-300">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 text-center">
                                        No contact messages found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        @if($contacts->hasPages())
            <div class="mt-8">
                {{ $contacts->links() }}
            </div>
        @endif
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
                <form id="deleteForm" method="POST" class="inline">
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
    function showDeleteDialog(contactId, contactName) {
        document.getElementById('deleteContactName').textContent = contactName;
        document.getElementById('deleteForm').action = `/admin/contacts/${contactId}`;
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