@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="bg-gray-800 shadow-xl rounded-lg p-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-white mb-2">
                    Reset your password
                </h2>
                <p class="text-gray-400 text-sm">
                    Enter your email address and we'll send you a link to reset your password.
                </p>
            </div>

            @if (session('status'))
                <div class="mt-6 rounded-lg bg-green-900 border border-green-700 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-300">
                                {{ session('status') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <form class="mt-8 space-y-6" action="{{ route('password.email') }}" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email address</label>
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        required 
                        class="appearance-none relative block w-full px-4 py-3 border border-gray-700 placeholder-gray-500 text-white bg-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm transition-colors duration-200" 
                        placeholder="Enter your email address"
                        value="{{ old('email') }}"
                    >
                    @error('email')
                        <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button 
                        type="submit" 
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
                    >
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-blue-500 group-hover:text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </span>
                        Send reset link
                    </button>
                </div>

                <div class="text-center">
                    <a 
                        href="{{ route('login') }}" 
                        class="font-medium text-blue-400 hover:text-blue-300 transition-colors duration-200"
                    >
                        ← Back to login
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 