@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="max-w-3xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl">
                    Contact Us
                </h1>
                <p class="mt-4 text-lg text-gray-400">
                    Have a question or need assistance? We'd love to hear from you. Send us a message and we'll respond as soon as possible.
                </p>
            </div>

            @if(session('success'))
                <div class="mb-8 bg-green-900 border border-green-700 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-400">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Contact Form -->
            <div class="bg-gray-800 shadow-xl rounded-lg overflow-hidden">
                <div class="px-6 py-8 sm:p-8">
                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                value="{{ old('name') }}"
                                class="block w-full border-gray-700 bg-gray-900 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-4 py-3"
                                placeholder="Enter your full name"
                                required
                            >
                            @error('name')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                value="{{ old('email') }}"
                                class="block w-full border-gray-700 bg-gray-900 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-4 py-3"
                                placeholder="Enter your email address"
                                required
                            >
                            @error('email')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Subject Field -->
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-300 mb-2">
                                Subject <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="subject" 
                                id="subject" 
                                value="{{ old('subject') }}"
                                class="block w-full border-gray-700 bg-gray-900 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-4 py-3"
                                placeholder="What is this about?"
                                required
                            >
                            @error('subject')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Message Field -->
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-300 mb-2">
                                Message <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                name="message" 
                                id="message" 
                                rows="6"
                                class="block w-full border-gray-700 bg-gray-900 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-4 py-3"
                                placeholder="Tell us more about your inquiry..."
                                required
                            >{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button 
                                type="submit" 
                                class="w-full bg-blue-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
                            >
                                <i class="fas fa-paper-plane mr-2"></i>
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <a href="https://maps.google.com/?q=123+Sigma+Street+Kuala+Lumpur+Malaysia" target="_blank" class="block group">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-600 text-white mx-auto mb-4 group-hover:bg-blue-700 transition-colors duration-200">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3 class="text-lg font-medium text-white mb-2">Address</h3>
                        <span class="text-gray-400 group-hover:text-blue-400 transition-colors duration-200">
                            123 Sigma Street<br>Kuala Lumpur, Malaysia
                        </span>
                    </a>
                </div>

                <div class="text-center">
                    <a href="tel:+60123456789" class="block group">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-600 text-white mx-auto mb-4 group-hover:bg-blue-700 transition-colors duration-200">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h3 class="text-lg font-medium text-white mb-2">Phone</h3>
                        <span class="text-gray-400 group-hover:text-blue-400 transition-colors duration-200">
                            +60 12-345 6789
                        </span>
                    </a>
                </div>

                <div class="text-center">
                    <a href="mailto:info@sigmashop.com" class="block group">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-600 text-white mx-auto mb-4 group-hover:bg-blue-700 transition-colors duration-200">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3 class="text-lg font-medium text-white mb-2">Email</h3>
                        <span class="text-gray-400 group-hover:text-blue-400 transition-colors duration-200">
                            info@sigmashop.com
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 