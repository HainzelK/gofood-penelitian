<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilihan Restoran - {{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap">
</head>
<body class="bg-[#f2f8f2] min-h-screen flex flex-col font-sans">

    <!-- Header -->
    <header class="bg-white py-3 px-6 shadow-sm border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Tombol Kembali (Kiri) -->
            <div class="w-24">
                <a href="javascript:history.back()" class="inline-flex items-center justify-center w-10 h-10 bg-[#ffcc00] rounded-lg shadow-sm hover:bg-[#e6b800] transition-colors">
                    <i class="fas fa-arrow-left text-black text-xl"></i>
                </a>
            </div>

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
    <main class="flex-grow flex flex-col items-center px-6 py-12">
        
        <h1 class="text-xl md:text-2xl font-bold text-gray-800 mb-10 text-center">
            Restoran yang mungkin Anda sukai di Kota {{ session('domisili') }}
        </h1>

        <!-- Grid Restoran -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 w-full max-w-6xl justify-center">
            
            @forelse($restoran as $item)
            <!-- Card Restoran -->
            <div class="bg-white rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col group border border-transparent hover:border-gray-100">
                <!-- Image Container -->
                <!-- Bagian Gambar di dalam Loop @forelse -->
                <div class="aspect-[4/3] w-full overflow-hidden bg-gray-100">
                    <img src="{{ asset('storage/' . str_replace(' ', '', $item->Nama) . '.png') }}" 
                         alt="{{ $item->Nama }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                         onerror="this.src='https://via.placeholder.com/400x300?text=Image+Not+Found'">
                </div>

                <!-- Detail Container -->
                <div class="p-6 text-center">
                    <h2 class="text-lg font-bold text-gray-800 mb-1">{{ $item->Nama }}</h2>
                    <p class="text-sm text-gray-500 font-medium">{{ $item->Ket }}</p>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-20">
                <p class="text-gray-500">Tidak ada restoran tersedia untuk kategori ini.</p>
            </div>
            @endforelse

        </div>

    </main>

</body>
</html>