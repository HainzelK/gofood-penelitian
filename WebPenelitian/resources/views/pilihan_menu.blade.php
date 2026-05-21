<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Menu - Go-Food</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f2f8f2] min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-white py-3 px-6 shadow-sm border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Spacer agar logo tetap di tengah -->
            <div class="w-24 hidden md:block"></div>

            <!-- Logo (Center) -->
            <span class="text-[#00880d] font-bold text-xl tracking-tight">go-food.site</span>

            <!-- Saldo (Right) -->
            <div class="relative border border-[#00880d] rounded-2xl px-4 py-1 text-right bg-white">
                <span class="font-medium absolute -top-2 right-16 bg-white px-1 text-[12px] text-gray-800">Saldo Anda</span>
                <span class="text-2xl font-bold text-gray-800">Rp60,000</span>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex flex-col items-center justify-center px-6 py-12">
        
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-12 text-center">
            Pilih jenis makanan yang Anda inginkan
        </h1>

        <!-- Container Kartu -->
        <div class="flex flex-col md:flex-row gap-20 w-full max-w-4xl justify-center items-stretch">
            
            <!-- Menu Reguler -->
            <a href="{{ route('restoran.jenis', 'TGGL') }}" class="flex-1 bg-white p-8 md:p-12 rounded-[2.5rem] shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col items-center group border border-transparent hover:border-gray-100">
                <div class="w-40 h-40 mb-8 flex items-center justify-center transform group-hover:scale-110 transition-transform">
                    <!-- Ganti dengan asset() gambar Anda -->
                    <img src="{{ asset('storage/menu-reguler.png') }}" alt="Menu Reguler" class="w-full h-full object-contain">
                </div>
                <h2 class="text-xl font-bold text-gray-700">Menu Reguler</h2>
            </a>

            <!-- Menu Sehat -->
            <a href="{{ route('restoran.jenis', 'HF') }}" class="flex-1 bg-white p-8 md:p-12 rounded-[2.5rem] shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col items-center group border border-transparent hover:border-gray-100">
                <div class="w-40 h-40 mb-8 flex items-center justify-center transform group-hover:scale-110 transition-transform">
                    <!-- Ganti dengan asset() gambar Anda -->
                    <img src="{{ asset('storage/menu-sehat.png') }}" alt="Menu Sehat" class="w-full h-full object-contain">
                </div>
                <h2 class="text-xl font-bold text-gray-700">Menu Sehat</h2>
            </a>

        </div>

    </main>

</body>
</html>