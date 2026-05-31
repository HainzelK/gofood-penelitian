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
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
</head>
<body class="bg-[#f2f8f2] min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-white py-3 px-4 md:px-6 shadow-sm border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="w-12 md:w-24">
                <a href="javascript:history.back()" class="inline-flex items-center justify-center w-10 h-10 bg-[#ffcc00] rounded-xl shadow-sm hover:bg-[#e6b800] transition-transform active:scale-95 text-black">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <div class="flex items-center justify-center gap-2 flex-1 md:flex-none">
                <div class="bg-[#00880d] text-white font-black text-xs md:text-sm w-7 h-7 md:w-8 md:h-8 rounded-lg flex items-center justify-center shadow-sm">
                    GF
                </div>
                <span class="text-[#00880d] font-bold text-lg md:text-xl tracking-tight">go-food.site</span>
            </div>
            <div class="relative border border-[#00880d] rounded-xl md:rounded-2xl px-3 py-1 text-right bg-white min-w-[100px] md:min-w-[130px]">
                <span class="font-bold absolute -top-2 right-4 bg-white px-2 text-[10px] md:text-[10px] text-[#00880d] uppercase">Saldo Anda</span>
                <span id="display-saldo-header" class="text-sm md:text-xl font-bold text-gray-800">Rp60,000</span>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex flex-col items-center px-3 md:px-6 py-6 md:py-10">
        
        <div class="max-w-6xl w-full">
            <h1 class="text-lg md:text-2xl font-bold text-gray-800 mb-1">
                Restoran di {{ session('domisili') ?? 'Kota Anda' }}
            </h1>
            <p class="text-gray-500 mb-6 md:mb-10 text-xs md:text-base">Berdasarkan pilihan menu yang Anda sukai</p>

            <!-- Grid Restoran (Update: grid-cols-2 untuk HP) -->
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-8">
                
                @forelse($restoran as $item)
                <!-- Card Restoran (Clickable) -->
                <a href="{{ route('restoran.menu', $item->idrestoran) }}" class="bg-white rounded-[1.5rem] md:rounded-[2.5rem] shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col group border border-gray-50 active:scale-[0.98]">
                    
                    <!-- Image Container -->
                    <div class="aspect-[4/3] w-full overflow-hidden bg-gray-100 relative">
                        <!-- Badge Promo - Ukuran mengecil di HP -->
                        <div class="absolute top-2 left-2 md:top-4 md:left-4 bg-[#00880d] text-white text-[8px] md:text-[10px] font-bold px-2 py-0.5 md:px-3 md:py-1 rounded-full z-10 shadow-sm">
                            PROMO
                        </div>

                        <img src="{{ asset('storage/' . str_replace(' ', '', $item->Nama) . '.png') }}" 
                             alt="{{ $item->Nama }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                             onerror="this.src='https://via.placeholder.com/400x300?text=Logo+Restoran'">
                    </div>

                    <!-- Detail Container (Padding menyesuaikan HP) -->
                    <div class="p-3 md:p-6">
                        <div class="flex flex-col md:flex-row justify-between items-start mb-1 md:mb-2">
                            <h2 class="text-sm md:text-lg font-bold text-gray-900 group-hover:text-[#00880d] transition-colors line-clamp-1">
                                {{ $item->Nama }}
                            </h2>
                            <div class="flex items-center gap-1 text-[10px] md:text-sm font-bold text-yellow-500">
                                <i class="fas fa-star"></i>
                                <span class="text-gray-700">4.7</span>
                            </div>
                        </div>
                        
                        <p class="text-[10px] md:text-sm text-gray-500 line-clamp-1 mb-2 md:mb-4">{{ $item->Ket }}</p>
                        
                        <div class="pt-2 md:pt-4 border-t border-gray-50 flex items-center justify-between md:justify-start gap-2 md:gap-3 text-[9px] md:text-[12px] font-semibold text-gray-400">
                            <span>1.2 km</span>
                            <span class="hidden md:inline">•</span>
                            <span>20-30 mnt</span>
                        </div>
                    </div>
                </a>
                @empty
                <!-- Tampilan jika kosong -->
                <div class="col-span-full flex flex-col items-center py-20">
                    <i class="fas fa-store-slash text-5xl text-gray-200 mb-4"></i>
                    <p class="text-gray-500 font-medium text-sm md:text-base">Maaf, tidak ada restoran tersedia.</p>
                    <a href="javascript:history.back()" class="mt-4 text-[#00880d] font-bold hover:underline text-sm">Kembali pilih menu</a>
                </div>
                @endforelse

            </div>
        </div>

    </main>
    
    <script>
        window.addEventListener('pageshow', function(event) {
            updateHeaderSaldo();

            clearCart()
        });

        function clearCart() {
            localStorage.removeItem('gofood_cart');
        }
    
        // Kita buat fungsi terpisah agar bisa dipanggil kapan saja
        function updateHeaderSaldo() {
            const saldoHeader = document.getElementById('display-saldo-header');
            if (saldoHeader) {
                // Ambil saldo terbaru dari localStorage
                const currentSaldo = parseInt(localStorage.getItem('gofood_saldo')) || 60000;
                
                // Update teks di header
                saldoHeader.innerText = "Rp" + currentSaldo.toLocaleString('id-ID');
                
                console.log("Saldo diupdate otomatis:", currentSaldo);
            }
        }    </script>

    <!-- Footer Space -->
    <div class="h-10 md:h-20"></div>

</body>
</html>