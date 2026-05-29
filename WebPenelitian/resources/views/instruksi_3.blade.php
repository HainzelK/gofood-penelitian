<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buka Aplikasi Go-Food</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col overflow-hidden">

    <!-- Header -->
    <header class="bg-white py-2 shadow-sm border-b border-gray-100 flex justify-center flex-shrink-0">
        <span class="text-[#00880d] font-bold text-lg tracking-tight">go-food.site</span>
    </header>

    <main class="relative flex-grow flex items-center justify-center overflow-hidden">
        
        <!-- Background Image (Gambar Orang Pegang HP) -->
        <div class="absolute inset-0 z-0">
            <!-- Gambar Desktop -->
            <img src="{{ asset('storage/instruksi3-desktop-.PNG') }}" 
                 alt="Desktop" 
                 class="hidden md:block w-full h-full object-cover object-top">
            
            <!-- Gambar HP -->
            <img src="{{ asset('storage/phone_instruksi3.jpeg') }}" 
                 alt="Mobile" 
                 class="block md:hidden w-full h-full object-cover object-top">
            
            <div class="absolute inset-0 bg-black/10"></div>
        </div>

        <!-- Sidebar Panel (Kiri) -->
        <div class="absolute left-4 md:left-10 top-10 md:top-20 w-[90%] md:w-[320px] bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl p-6 z-10 border border-gray-100">
            
            <div class="flex items-start gap-4">
                <!-- Badge Angka 3 -->
                <div class="bg-[#002d57] text-white w-9 h-9 flex-shrink-0 flex items-center justify-center rounded-lg font-bold text-xl">3</div>
                
                <!-- Teks Instruksi -->
                <p class="text-[14px] md:text-[15px] font-medium leading-relaxed text-gray-800">
                    Karena merasa lapar dan teringat berita tadi, Anda membuka aplikasi <span class="text-[#00880d] font-bold">Go-Food</span> untuk melihat menu makan siang.
                </p>
            </div>
        </div>

        <!-- Tombol Selanjutnya (Kanan Bawah) -->
        <div class="absolute bottom-10 left-0 right-0 md:left-auto md:right-10 flex justify-center md:block z-20">
            <a href="{{ route('pilihan.menu') }}" 
               class="w-[85%] md:w-auto text-center px-12 py-4 bg-[#00880d] text-white font-bold rounded-2xl hover:bg-[#00700a] transition-all text-lg shadow-xl">
                Selanjutnya
            </a>
        </div>
        
    </main>

</body>
</html>