<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Umum - Toraja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-white min-h-screen flex flex-col overflow-hidden">

    <!-- Header dengan tinggi tetap (64px) -->
    <header class="h-16 bg-white border-b border-gray-100 flex items-center justify-center z-50 flex-shrink-0">
        <span class="text-[#00880d] font-bold text-xl tracking-tight">go-food.site</span>
    </header>

    <!-- Main Container: Mengisi sisa layar -->
    <main class="relative flex-grow w-full flex flex-col">
        
        <!-- Background Image Container -->
        <div class="absolute inset-0 z-0">
            <!-- Gambar Desktop -->
            <img src="{{ asset('storage/toraja.PNG') }}" 
                 alt="Desktop" 
                 class="hidden md:block w-full h-full object-cover object-top">
            
            <!-- Gambar HP -->
            <img src="{{ asset('storage/phone_toraja.jpeg') }}" 
                 alt="Mobile" 
                 class="block md:hidden w-full h-full object-cover object-top">
            
            <div class="absolute inset-0 bg-black/10"></div>
        </div>

        <!-- Floating Info Card (MUNCUL DI HP & DESKTOP) -->
        <div class="relative z-10 w-[90%] md:w-[450px] bg-white/95 backdrop-blur-sm p-8 md:p-12 rounded-[2rem] md:rounded-[2.5rem] shadow-2xl mt-8 md:mt-20 mx-auto md:mr-24 md:ml-auto transition-all">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 md:mb-6">Informasi Umum</h1>
            <p class="text-gray-700 leading-relaxed text-sm md:text-base font-medium">
                Anda adalah pegawai di pusat Kota Rantepao atau Makale. Karena jadwal kerja yang padat, Anda mengandalkan Go-Food minimal 6x sebulan untuk makan siang.
            </p>
        </div>

        <!-- Floating Button Selanjutnya -->
        <div class="absolute bottom-10 left-0 right-0 md:left-auto md:right-10 flex justify-center md:block z-20">
            <a href="{{ route('detail.plotting') }}" 
               class="w-[85%] md:w-auto text-center px-12 py-4 bg-[#00880d] text-white font-bold rounded-2xl hover:bg-[#00700a] transition-all text-lg shadow-xl">
                Selanjutnya
            </a>
        </div>
        
    </main>

</body>
</html>