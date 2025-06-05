@extends('app')

@section('content')
<body class="bg-white min-h-screen flex items-center justify-center">

    <div class="w-full min-h-screen grid grid-cols-1 md:grid-cols-2">
        
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
                        {{-- <a href="#" class="text-sm text-yellow-500 hover:underline">Forgot Password?</a> --}}
                    </div>
                    <div class="flex items-center border rounded-md overflow-hidden">
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

</body>
</html>
@endsection