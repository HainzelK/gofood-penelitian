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
<!-- Header -->
    <header class="bg-white py-3 px-4 shadow-sm border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            
            <!-- Sisi Kiri (Kosong agar logo tetap di tengah) -->
            <div class="flex-1"></div>

            <!-- Logo (Pasti di Tengah) -->
            <div class="flex-grow flex justify-center">
                <span class="text-[#00880d] font-bold text-base md:text-xl tracking-tight truncate">go-food.site</span>
            </div>
            
            <!-- Saldo (Sisi Kanan) -->
            <div class="flex-1 flex justify-end">
                <div class="relative border border-[#00880d] rounded-xl px-3 py-1 bg-white min-w-[90px] md:min-w-[130px]">
                    <span class="font-bold absolute -top-2 right-3 bg-white px-1 text-[8px] md:text-[10px] text-[#00880d] uppercase whitespace-nowrap">Saldo Anda</span>
                    <span id="display-saldo-header" class="text-xs md:text-lg font-bold text-gray-800 block text-right">Rp60,000</span>
                </div>
            </div>
            
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex flex-col items-center justify-center px-4 py-8 md:py-12">
        
        <h1 class="text-xl md:text-3xl font-bold text-gray-800 mb-8 md:mb-12 text-center max-w-md md:max-w-none">
            Pilih jenis makanan yang Anda inginkan
        </h1>

        <!-- Container Kartu -->
        <div class="grid grid-cols-2 gap-4 md:gap-10 w-full max-w-4xl">
            
            <!-- Menu Reguler -->
            <a href="{{ route('restoran.jenis', 'TGGL') }}" class="bg-white p-5 md:p-12 rounded-3xl md:rounded-[2.5rem] shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col items-center group border border-transparent hover:border-gray-100">
                <div class="w-24 h-24 md:w-40 md:h-40 mb-4 md:mb-8 flex items-center justify-center transform group-hover:scale-110 transition-transform">
                    <img src="{{ asset('storage/menu-reguler.png') }}" alt="Menu Reguler" class="w-full h-full object-contain">
                </div>
                <h2 class="text-sm md:text-xl font-bold text-gray-700 text-center">Menu Reguler</h2>
            </a>

            <!-- Menu Sehat -->
            <a href="{{ route('restoran.jenis', 'HF') }}" class="bg-white p-5 md:p-12 rounded-3xl md:rounded-[2.5rem] shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col items-center group border border-transparent hover:border-gray-100">
                <div class="w-24 h-24 md:w-40 md:h-40 mb-4 md:mb-8 flex items-center justify-center transform group-hover:scale-110 transition-transform">
                    <img src="{{ asset('storage/menu-sehat.png') }}" alt="Menu Sehat" class="w-full h-full object-contain">
                </div>
                <h2 class="text-sm md:text-xl font-bold text-gray-700 text-center">Menu Sehat</h2>
            </a>

        </div>

    </main>

    <script>
        window.addEventListener('pageshow', function(event) {
            updateHeaderSaldo();

            clearCart();
        });
    
        function updateHeaderSaldo() {
            const saldoHeader = document.getElementById('display-saldo-header');
            if (saldoHeader) {
                const currentSaldo = parseInt(localStorage.getItem('gofood_saldo')) || 60000;
                saldoHeader.innerText = "Rp" + currentSaldo.toLocaleString('id-ID');
            }
        }
        updateHeaderSaldo();

        function clearCart() {
            localStorage.removeItem('gofood_cart');
        }
    </script>

</body>
</html>