@extends('app')

@section('content')
    <div class="w-full min-h-screen grid grid-cols-1 md:grid-cols-2 bg-white">
        
        <!-- Left Side - Illustration -->
        <div class="hidden md:flex items-center justify-center bg-gray-100">
            <img src="{{ asset('images/idspora_logo.svg') }}" alt="Idspora Logo" class="max-h-60 w-auto">
        </div>
        
        <!-- Right Side - Login Form -->
        <div class="flex flex-col justify-center px-6 py-12">
            <h2 class="text-4xl font-bold mb-6 text-gray-800 text-center">Login</h2>

            <form method="POST" action="{{ route('login') }}" class="w-full max-w-md mx-auto space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block font-medium text-gray-700 mb-1">Email</label>
                    <div class="flex items-center border rounded-md overflow-hidden">
                        <span class="px-3 bg-white border-r text-gray-400">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.94 6.94A1.5 1.5 0 0 1 4.5 6h11a1.5 1.5 0 0 1 1.56.94L10 11.586 2.94 6.94z"/>
                                <path d="M2 8.5v6A1.5 1.5 0 0 0 3.5 16h13a1.5 1.5 0 0 0 1.5-1.5v-6l-7.5 4.5L2 8.5z"/>
                            </svg>
                        </span>
                        <input 
                            type="email" 
                            id="email" 
                            name="email"
                            placeholder="you@example.com"
                            class="w-full px-3 py-2 outline-none text-sm"
                            value="{{ old('email') }}" 
                            required>
                    </div>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label for="password" class="block font-medium text-gray-700">Password</label>
                    </div>
                    <div class="flex items-center border rounded-md overflow-hidden relative">
                        <span class="px-3 bg-white border-r text-gray-400">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v2H5a2 2 0 00-2 2v6a2 
                                    2 0 002 2h10a2 2 0 002-2v-6a2 2 0 
                                    00-2-2h-1V6a4 4 0 00-4-4zm-2 
                                    6V6a2 2 0 114 0v2H8z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <input 
                            type="password" 
                            id="password" 
                            name="password"
                            placeholder="••••••••"
                            class="w-full px-3 py-2 outline-none text-sm"
                            required>

                        <!-- Toggle button -->
                        <button type="button" onclick="togglePassword()" class="absolute right-3 text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 
                                    9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <button type="submit" class="w-full bg-gray-800 text-white py-2 rounded-md hover:bg-gray-900 transition font-semibold">
                    Log In
                </button>
            </form>
        </div>
    </div>

    <!-- Script to toggle password visibility -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 
                        9.956 0 012.117-3.362m3.242-2.318A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 
                        9.542 7a9.96 9.96 0 01-4.293 5.07M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3l18 18" />
                `;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268-2.943 
                        9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }
    </script>
@endsection