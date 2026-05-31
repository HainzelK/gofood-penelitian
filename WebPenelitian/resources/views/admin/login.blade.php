<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin Peneliti</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white p-8 md:p-10 rounded-3xl shadow-xl w-full max-w-md">
        <h2 class="text-2xl font-black text-[#00880d] mb-6">ADMIN LOGIN</h2>
        
        @if(session('error'))
            <p class="text-red-500 text-sm mb-4 font-bold">{{ session('error') }}</p>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Username</label>
                <input type="text" name="username" class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-green-500 outline-none" required>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Password</label>
                <input type="password" name="password" class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-green-500 outline-none" required>
            </div>
            <button type="submit" class="w-full bg-[#00880d] text-white font-bold py-3 rounded-xl hover:bg-[#00700a] transition-all">
                Masuk ke Dashboard
            </button>
        </form>
    </div>
</body>
</html>