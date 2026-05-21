<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilihan Restoran - {{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f2f8f2] min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-white py-3 px-6 shadow-sm border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Tombol Kembali -->
            <div class="w-24">
                <a href="javascript:history.back()" class="inline-flex items-center justify-center w-10 h-10 bg-[#ffcc00] rounded-xl shadow-sm hover:bg-[#e6b800] transition-transform active:scale-95">
                    <i class="fas fa-arrow-left text-black text-lg"></i>
                </a>
            </div>

            <!-- Logo -->
            <span class="text-[#00880d] font-bold text-xl tracking-tight">go-food.site</span>

            <!-- Saldo -->
            <div class="relative border border-[#00880d] rounded-2xl px-4 py-1.5 text-right bg-white min-w-[120px]">
                <span class="font-bold absolute -top-2.5 right-6 bg-white px-1 text-[10px] text-[#00880d] uppercase tracking-wider">Saldo Anda</span>
                <span class="text-xl md:text-2xl font-extrabold text-gray-800 tracking-tight">Rp60,000</span>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex flex-col items-center px-4 md:px-6 py-10">
        
        <div class="max-w-6xl w-full">
            <h1 class="text-xl md:text-2xl font-bold text-gray-800 mb-2">
                Restoran di {{ session('domisili') ?? 'Kota Anda' }}
            </h1>
            <p class="text-gray-500 mb-10 text-sm md:text-base">Berdasarkan pilihan menu yang Anda sukai</p>

            <!-- Grid Restoran -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                
                @forelse($restoran as $item)
                <!-- Card Restoran (Clickable) -->
                <a href="{{ route('restoran.menu', $item->idrestoran) }}" class="bg-white rounded-[2.5rem] shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col group border border-gray-50 active:scale-[0.98]">
                    
                    <!-- Image Container -->
                    <div class="aspect-[4/3] w-full overflow-hidden bg-gray-100 relative">
                        <!-- Badge Promo/Label (Opsional agar lebih mirip GoFood) -->
                        <div class="absolute top-4 left-4 bg-[#00880d] text-white text-[10px] font-bold px-3 py-1 rounded-full z-10 shadow-sm">
                            PROMO
                        </div>

                        <img src="{{ asset('storage/' . str_replace(' ', '', $item->Nama) . '.png') }}" 
                             alt="{{ $item->Nama }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                             onerror="this.src='https://via.placeholder.com/400x300?text=Logo+Restoran'">
                    </div>

                    <!-- Detail Container -->
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h2 class="text-lg font-bold text-gray-900 group-hover:text-[#00880d] transition-colors">
                                {{ $item->Nama }}
                            </h2>
                            <div class="flex items-center gap-1 text-sm font-bold">
                                <i class="fas fa-star text-yellow-400"></i>
                                <span>4.7</span>
                            </div>
                        </div>
                        
                        <p class="text-sm text-gray-500 line-clamp-1 mb-4">{{ $item->Ket }}</p>
                        
                        <div class="pt-4 border-t border-gray-50 flex items-center gap-3 text-[12px] font-semibold text-gray-400">
                            <span>1.2 km</span>
                            <span>•</span>
                            <span>20-30 mnt</span>
                        </div>
                    </div>
                </a>
                @empty
                <!-- Tampilan jika kosong -->
                <div class="col-span-full flex flex-col items-center py-20">
                    <i class="fas fa-store-slash text-5xl text-gray-200 mb-4"></i>
                    <p class="text-gray-500 font-medium">Maaf, tidak ada restoran tersedia untuk kategori ini.</p>
                    <a href="javascript:history.back()" class="mt-4 text-[#00880d] font-bold hover:underline">Kembali pilih menu</a>
                </div>
                @endforelse

            </div>
        </div>

    </main>

    <!-- Footer Space -->
    <div class="h-20"></div>

</body>
</html>