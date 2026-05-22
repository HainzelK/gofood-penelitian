<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $restoran->Nama }} - Go-Food</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* Highlight border saat item dipilih */
        .selected-card { border-color: #00880d !important; border-width: 2px !important; }
        
        @keyframes slideUp {
            from { transform: translate(-50%, 100%); opacity: 0; }
            to { transform: translate(-50%, 0); opacity: 1; }
        }
        .animate-cart { animation: slideUp 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; }
    </style>
</head>
<body class="bg-[#f2f8f2] min-h-screen flex flex-col relative">

    <!-- Header -->
    <header class="bg-white py-4 px-6 shadow-sm border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="w-24">
                <a href="javascript:history.back()" class="inline-flex items-center justify-center w-10 h-10 bg-[#ffcc00] rounded-xl shadow-sm hover:bg-[#e6b800] transition-transform active:scale-95 text-black">
                    <i class="fas fa-arrow-left text-lg"></i>
                </a>
            </div>
            <span class="text-[#00880d] font-bold text-xl tracking-tight">go-food.site</span>
            <div class="relative border border-[#00880d] rounded-2xl px-4 py-1.5 text-right bg-white min-w-[130px]">
                <span class="font-bold absolute -top-2.5 right-6 bg-white px-1 text-[10px] text-[#00880d] uppercase">Saldo Anda</span>
                <span class="text-xl font-extrabold text-gray-800 tracking-tight">Rp60,000</span>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto w-full px-4 md:px-6 py-10">
        <h2 class="text-2xl font-extrabold text-gray-800 mb-8 tracking-tight uppercase text-sm border-l-4 border-[#00880d] pl-3">Daftar Menu</h2>

        <!-- Grid Menu -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10">
            @forelse($menuItems as $menu)
            @php
                // AMBIL LANGSUNG DARI KOLOM 'Jenis' DI DATABASE
                $kat = strtolower($menu->Jenis); // 'makanan' atau 'minuman'
            @endphp
            
            <!-- Card Menu -->
            <div id="card-{{ $menu->idmenu }}" class="menu-card bg-white rounded-[2.8rem] shadow-sm p-6 border-2 border-transparent transition-all duration-300 flex flex-col h-full group relative">
                <div class="aspect-video w-full rounded-[2.2rem] overflow-hidden mb-5 bg-gray-50">
                    <img src="{{ asset('storage/' . str_replace([' ', '+'], '_', strtolower($menu->NamaMenu)) . '.png') }}" 
                         alt="{{ $menu->NamaMenu }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                </div>

                <div class="px-1 flex-grow flex flex-col justify-between">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 leading-tight">{{ $menu->NamaMenu }}</h3>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-900 font-extrabold text-lg">Rp{{ number_format($menu->Harga, 0, ',', '.') }}</span>
                        
                        <!-- TOMBOL + (Selalu Hijau khas GoFood) -->
                        <button id="btn-{{ $menu->idmenu }}" 
                                onclick="addToCart('{{ $menu->idmenu }}', '{{ $menu->NamaMenu }}', {{ $menu->Harga }}, '{{ $kat }}')" 
                                class="w-12 h-12 bg-[#00880d] text-white rounded-2xl flex items-center justify-center hover:bg-[#00700a] transition-all shadow-md active:scale-90 z-10">
                            <i id="icon-{{ $menu->idmenu }}" class="fas fa-plus text-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
            @empty
                <p class="col-span-full text-center py-20 text-gray-400 italic">Menu belum tersedia.</p>
            @endforelse
        </div>
    </main>

    <!-- FLOATING CART MODAL (KUNING) -->
    <div id="cart-modal" class="hidden fixed bottom-10 left-1/2 -translate-x-1/2 w-[92%] max-w-4xl bg-[#fdfde1] rounded-[2.5rem] p-4 md:p-5 shadow-2xl z-[100] border border-yellow-200 items-center justify-between animate-cart">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm text-[#00880d]">
                <i class="fas fa-shopping-basket text-2xl"></i>
            </div>
            <div class="flex flex-col">
                <span class="font-bold text-gray-900 text-lg leading-tight">Keranjang Saya</span>
                <span id="cart-items-list" class="text-[11px] text-gray-500 font-medium truncate max-w-[180px] md:max-w-xs italic">Belum ada pesanan</span>
            </div>
        </div>

        <div class="flex items-center gap-6">
            <div class="text-right hidden sm:block">
                <span class="text-[9px] text-gray-400 block uppercase font-bold tracking-widest">Total Pembayaran</span>
                <span id="cart-total-price" class="font-extrabold text-gray-900 text-2xl tracking-tighter">Rp0</span>
            </div>
            <button class="px-8 md:px-12 py-3.5 bg-[#00880d] text-white font-bold rounded-2xl hover:bg-[#00700a] transition-all shadow-lg active:scale-95 text-lg">
                Cek Keranjang
            </button>
        </div>
    </div>

    <div class="h-32"></div>

    <script>
        // State: 1 slot makanan, 1 slot minuman
        let cartState = {
            makanan: null,
            minuman: null
        };

        function addToCart(id, name, price, type) {
            // Logika: Item sejenis akan menimpa yang lama.
            // Bisa digabung (1 Makanan + 1 Minuman).
            cartState[type] = { id, name, price };
            updateUI();
        }

        function updateUI() {
            const modal = document.getElementById('cart-modal');
            const listText = document.getElementById('cart-items-list');
            const totalText = document.getElementById('cart-total-price');
            
            // Reset semua card ke abu-abu
            document.querySelectorAll('.menu-card').forEach(c => c.classList.remove('selected-card'));
            // Reset semua ikon tombol ke plus (+)
            document.querySelectorAll('button i[id^="icon-"]').forEach(icon => {
                icon.className = 'fas fa-plus text-lg';
            });

            let total = 0;
            let names = [];

            // Proses slot makanan dan minuman
            Object.keys(cartState).forEach(type => {
                const item = cartState[type];
                if (item) {
                    total += item.price;
                    names.push(item.name);
                    
                    // Aktifkan border hijau pada card terpilih
                    const card = document.getElementById(`card-${item.id}`);
                    if(card) card.classList.add('selected-card');
                    
                    // Ubah ikon tombol terpilih jadi centang (v)
                    const icon = document.getElementById(`icon-${item.id}`);
                    if(icon) icon.className = 'fas fa-check text-lg';
                }
            });

            if (names.length > 0) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                listText.innerText = names.join(' + ');
                totalText.innerText = `Rp${total.toLocaleString('id-ID')}`;
            } else {
                modal.classList.add('hidden');
            }
        }
    </script>
</body>
</html>