@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen bg-gray-900 py-12">
    <div class="max-w-md mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-8 bg-gray-800 border-b border-gray-700">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-white">Login</h2>
                    <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-white text-gray-900 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-200 transition-colors duration-200">
                        Register
                    </a>
                </div>

                @if (session('status'))
                    <div class="mb-6 bg-green-900 border border-green-700 text-green-200 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('status') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Role Selection -->
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="customer" class="peer hidden" {{ old('role', 'customer') == 'customer' ? 'checked' : '' }}>
                            <div class="flex items-center justify-center p-4 border-2 border-gray-700 rounded-xl peer-checked:border-indigo-500 peer-checked:bg-indigo-900 peer-checked:text-white hover:bg-gray-700 transition-all duration-200">
                                <i class="fas fa-user mr-2"></i>
                                <span class="font-medium text-white">Customer</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="admin" class="peer hidden" {{ old('role') == 'admin' ? 'checked' : '' }}>
                            <div class="flex items-center justify-center p-4 border-2 border-gray-700 rounded-xl peer-checked:border-indigo-500 peer-checked:bg-indigo-900 peer-checked:text-white hover:bg-gray-700 transition-all duration-200">
                                <i class="fas fa-user-shield mr-2"></i>
                                <span class="font-medium text-white">Admin</span>
                            </div>
                        </label>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus class="block w-full px-4 py-3 rounded-lg border-gray-700 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
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

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" name="remember" id="remember" class="h-4 w-4 rounded border-gray-700 bg-gray-700 text-indigo-600 focus:ring-indigo-500">
                            <label for="remember" class="ml-2 block text-sm text-gray-300">Remember me</label>
                        </div>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-indigo-400 hover:text-indigo-300">
                                Forgot your password?
                            </a>
                        @endif
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 bg-indigo-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 