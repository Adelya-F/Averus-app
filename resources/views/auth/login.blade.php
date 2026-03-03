<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex items-center justify-center bg-[#faf6ef] px-4">

    <div class="bg-white w-full max-w-md sm:max-w-lg p-6 sm:p-8 rounded-2xl shadow-2xl">

        <h2 class="text-2xl sm:text-3xl font-bold text-center text-blue-700 mb-2">
            Selamat Datang
        </h2>

        <p class="text-center text-sm sm:text-base text-gray-600 mb-6">
            Masuk untuk melanjutkan pembelajaran Anda
        </p>

        @if (session('status'))
            <div class="mb-4 text-green-600 text-sm text-center">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">
                    Email
                </label>
                <input 
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                >
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">
                    Password
                </label>

                <div class="relative">
                    <input 
                        type="password"
                        name="password"
                        id="password"
                        required
                        class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none pr-10"
                    >

                    <!-- Toggle Button -->
                    <button 
                        type="button"
                        onclick="togglePassword()"
                        class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-blue-600"
                    >
                        <!-- Eye Open -->
                        <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" 
                            class="h-5 w-5" fill="none" viewBox="0 0 24 24" 
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5
                                c4.477 0 8.268 2.943 9.542 7
                                -1.274 4.057-5.065 7-9.542 7
                                -4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>

                        <!-- Eye Closed -->
                        <svg id="eye-closed" xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3l18 18"/>
                        </svg>
                    </button>
                </div>

                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember -->
            <div class="flex items-center justify-between mb-6 text-sm">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2">
                    Remember me
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" 
                       class="text-blue-600 hover:underline">
                        Forgot?
                    </a>
                @endif
            </div>

            <button 
                type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition"
            >
                Log In
            </button>

        </form>
    </div>

<script>
function togglePassword() {
    const password = document.getElementById('password');
    const eyeOpen = document.getElementById('eye-open');
    const eyeClosed = document.getElementById('eye-closed');

    if (password.type === "password") {
        password.type = "text";
        eyeOpen.classList.add("hidden");
        eyeClosed.classList.remove("hidden");
    } else {
        password.type = "password";
        eyeOpen.classList.remove("hidden");
        eyeClosed.classList.add("hidden");
    }
}
</script>

</body>
</html>