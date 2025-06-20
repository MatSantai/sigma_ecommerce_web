@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-h-screen bg-gray-900 py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-8 bg-gray-800 border-b border-gray-700">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-white">Register</h2>
                    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-white text-gray-900 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-200 transition-colors duration-200">
                        Back to Login
                    </a>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus class="block w-full px-4 py-3 rounded-lg border-gray-700 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('name')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required class="block w-full px-4 py-3 rounded-lg border-gray-700 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('email')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                            <input type="password" name="password" id="password" required class="block w-full px-4 py-3 rounded-lg border-gray-700 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('password')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required class="block w-full px-4 py-3 rounded-lg border-gray-700 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-300 mb-2">Phone</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required class="block w-full px-4 py-3 rounded-lg border-gray-700 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('phone')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-300 mb-2">Address</label>
                            <input type="text" name="address" id="address" value="{{ old('address') }}" required class="block w-full px-4 py-3 rounded-lg border-gray-700 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('address')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-300 mb-2">City</label>
                            <input type="text" name="city" id="city" value="{{ old('city') }}" required class="block w-full px-4 py-3 rounded-lg border-gray-700 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('city')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="state" class="block text-sm font-medium text-gray-300 mb-2">State</label>
                            <input type="text" name="state" id="state" value="{{ old('state') }}" required class="block w-full px-4 py-3 rounded-lg border-gray-700 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('state')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="zip_code" class="block text-sm font-medium text-gray-300 mb-2">ZIP Code</label>
                            <input type="text" name="zip_code" id="zip_code" value="{{ old('zip_code') }}" required class="block w-full px-4 py-3 rounded-lg border-gray-700 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('zip_code')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-300 mb-2">Country</label>
                            <input type="text" name="country" id="country" value="{{ old('country') }}" required class="block w-full px-4 py-3 rounded-lg border-gray-700 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('country')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 bg-indigo-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 