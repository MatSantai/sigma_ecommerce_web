@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-gray-800 border-b border-gray-700">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-white">Edit Profile</h2>
                    <a href="{{ route('profile.show') }}" class="inline-flex items-center px-4 py-2 bg-white text-gray-900 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-200 transition-colors duration-200">
                        Back to Profile
                    </a>
                </div>

                @if (session('success'))
                    <div class="mb-4 bg-green-900 border border-green-700 text-green-200 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST" class="space-y-10">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div>
                            <h3 class="text-lg font-medium text-white mb-6">Personal Information</h3>
                            <div class="space-y-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4 py-3">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4 py-3">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-300 mb-2">Phone</label>
                                    <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4 py-3">
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-white mb-6">Address Information</h3>
                            <div class="space-y-6">
                                <div>
                                    <label for="address" class="block text-sm font-medium text-gray-300 mb-2">Address</label>
                                    <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4 py-3">
                                    @error('address')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-300 mb-2">City</label>
                                    <input type="text" name="city" id="city" value="{{ old('city', $user->city) }}" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4 py-3">
                                    @error('city')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="state" class="block text-sm font-medium text-gray-300 mb-2">State</label>
                                    <input type="text" name="state" id="state" value="{{ old('state', $user->state) }}" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4 py-3">
                                    @error('state')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="zip_code" class="block text-sm font-medium text-gray-300 mb-2">ZIP Code</label>
                                    <input type="text" name="zip_code" id="zip_code" value="{{ old('zip_code', $user->zip_code) }}" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4 py-3">
                                    @error('zip_code')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="country" class="block text-sm font-medium text-gray-300 mb-2">Country</label>
                                    <input type="text" name="country" id="country" value="{{ old('country', $user->country) }}" class="mt-1 block w-full rounded-md border-gray-700 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4 py-3">
                                    @error('country')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-10">
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Account Section -->
        <div class="mt-8 bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-gray-800 border-t border-gray-700">
                <h3 class="text-lg font-medium text-red-400">Delete Account</h3>
                <p class="mt-1 text-sm text-gray-400">
                    Once your account is deleted, all of its resources and data will be permanently deleted.
                </p>
                <div class="mt-4">
                    <button type="button" onclick="showDeleteConfirmation()" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Delete Account
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Confirmation Modal -->
<div id="deleteConfirmationDialog" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-gray-800 rounded-lg shadow-xl max-w-lg w-full mx-4 transform transition-all">
        <div class="p-6">
            <h3 class="text-lg font-medium text-white">Are you sure you want to delete your account?</h3>
            <p class="mt-2 text-sm text-gray-400">
                Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
            </p>
            <form action="{{ route('profile.destroy') }}" method="POST" id="deleteAccountForm" class="mt-4">
                @csrf
                @method('DELETE')
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" required
                           class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500"
                           placeholder="Password">
                    @error('password', 'deleteAccount')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </form>
        </div>
        <div class="px-6 py-4 bg-gray-800 border-t border-gray-700 flex justify-end space-x-3">
            <button type="button" onclick="hideDeleteConfirmation()" class="px-4 py-2 border border-gray-600 text-gray-300 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                Cancel
            </button>
            <button type="button" onclick="document.getElementById('deleteAccountForm').submit();" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                Delete Account
            </button>
        </div>
    </div>
</div>

<script>
function showDeleteConfirmation() {
    document.getElementById('deleteConfirmationDialog').classList.remove('hidden');
}

function hideDeleteConfirmation() {
    document.getElementById('deleteConfirmationDialog').classList.add('hidden');
}
</script>
@endsection 