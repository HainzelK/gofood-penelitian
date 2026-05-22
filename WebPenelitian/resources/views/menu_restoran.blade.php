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
        
        .selected-card { border-color: #00880d !important; border-width: 2px !important; background-color: #f0fdf4; }
        
        @keyframes slideUp {
            from { transform: translate(-50%, 100%); opacity: 0; }
            to { transform: translate(-50%, 0); opacity: 1; }
        }
        .animate-cart { animation: slideUp 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; }
    </style>
</head>
<body class="bg-[#f2f8f2] min-h-screen flex flex-col relative">

    <!-- Header -->
    <header class="bg-white py-3 px-6 shadow-sm border-b border-gray-100 sticky top-0 z-50">
        
        <div class="max-w-7xl mx-auto flex justify-between items-center">
                        <!-- Tombol Kembali -->
            <div class="w-24">
                <a href="javascript:history.back()" class="inline-flex items-center justify-center w-10 h-10 bg-[#ffcc00] rounded-xl shadow-sm hover:bg-[#e6b800] transition-transform active:scale-95">
                    <i class="fas fa-arrow-left text-black text-lg"></i>
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

    

    <main class="max-w-7xl mx-auto w-full px-4 md:px-6 py-10">
        
        <!-- PROFIL RESTORAN (Tambahan Sesuai Template) -->
        <section class="flex flex-col md:flex-row items-center md:items-start gap-6 md:gap-10 mb-14">
            <!-- Foto Utama Restoran -->
            <div class="w-full md:w-80 h-48 md:h-52 rounded-[2.5rem] overflow-hidden shadow-xl border-4 border-white shrink-0">
                <img src="{{ asset('storage/' . str_replace([' '], '', ($restoran->Nama)) . '.png') }}" 
                     alt="{{ $restoran->Nama }}" 
                     class="w-full h-full object-cover"
                     onerror="this.src='https://via.placeholder.com/600x400?text=Restoran'">
            </div>
            
            <!-- Detail Restoran -->
            <div class="text-center md:text-left pt-2">
                <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-2 tracking-tight">
                    {{ $restoran->Nama }}
                </h1>
                <p class="text-lg md:text-xl text-gray-500 font-medium italic">
                    {{ $restoran->Ket ?? 'Indonesian Comfort Food' }}
                </p>
                <div class="flex items-center justify-center md:justify-start gap-4 mt-5 text-sm font-bold text-gray-400">
                    <span class="flex items-center gap-1.5 bg-yellow-50 text-yellow-700 px-3 py-1 rounded-full text-xs">
                        <i class="fas fa-star"></i> 4.8
                    </span>
                    <span>•</span>
                    <span>Indonesian Food</span>
                </div>
            </div>
        </section>

        <!-- Judul Daftar Menu -->
        <h2 class="text-2xl font-extrabold text-gray-800 mb-8 tracking-tight uppercase text-sm border-l-4 border-[#00880d] pl-3">Daftar Menu</h2>

        <!-- Grid Menu (Mobile: 2 Kolom, Desktop: 3 Kolom) -->
        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-10">
            @forelse($menuItems as $menu)
            @php
                $kat = strtolower($menu->Jenis); 
            @endphp
            
            <!-- Card Menu -->
            <div id="card-{{ $menu->idmenu }}" class="menu-card bg-white rounded-[1.8rem] md:rounded-[2.8rem] shadow-sm p-4 md:p-6 border-2 border-transparent transition-all duration-300 flex flex-col h-full group relative">
                <div class="aspect-video w-full rounded-[1.2rem] md:rounded-[2.2rem] overflow-hidden mb-4 md:mb-5 bg-gray-50">
                    <img src="{{ asset('storage/' . str_replace([' ', '+'], '_', strtolower($menu->NamaMenu)) . '.png') }}" 
                         alt="{{ $menu->NamaMenu }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                </div>

                <div class="px-1 flex-grow flex flex-col justify-between">
                    <h3 class="text-sm md:text-lg font-bold text-gray-900 mb-3 md:mb-4 leading-tight line-clamp-2">{{ $menu->NamaMenu }}</h3>
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-2">
                        <span class="text-gray-900 font-extrabold text-sm md:text-xl">Rp{{ number_format($menu->Harga, 0, ',', '.') }}</span>
                        
                        <button id="btn-{{ $menu->idmenu }}" 
                                onclick="addToCart('{{ $menu->idmenu }}', '{{ $menu->NamaMenu }}', {{ $menu->Harga }}, '{{ $kat }}')" 
                                class="w-8 h-8 md:w-12 md:h-12 bg-[#00880d] text-white rounded-lg md:rounded-2xl flex items-center justify-center hover:bg-[#00700a] transition-all shadow-md active:scale-90 self-end md:self-auto">
                            <i id="icon-{{ $menu->idmenu }}" class="fas fa-plus text-xs md:text-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
            @empty
                <p class="col-span-full text-center py-20 text-gray-400 italic">Menu belum tersedia.</p>
            @endforelse
        </div>
    </main>

    <!-- FLOATING CART MODAL -->
    <div id="cart-modal" class="hidden fixed bottom-6 md:bottom-10 left-1/2 -translate-x-1/2 w-[95%] max-w-4xl bg-[#fdfde1] rounded-[1.5rem] md:rounded-[2.5rem] p-3 md:p-5 shadow-2xl z-[100] border border-yellow-200 items-center justify-between animate-cart">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 md:w-12 md:h-12 bg-white rounded-xl md:rounded-2xl flex items-center justify-center shadow-sm text-[#00880d]">
                <i class="fas fa-shopping-basket text-lg md:text-2xl"></i>
            </div>
            <div class="flex flex-col overflow-hidden">
                <span class="font-bold text-gray-900 text-sm md:text-lg leading-tight">Keranjang Saya</span>
                <span id="cart-items-list" class="text-[10px] md:text-[11px] text-gray-500 truncate max-w-[120px] md:max-w-xs italic font-medium">Belum ada pesanan</span>
            </div>
        </div>

        <div class="flex items-center gap-3 md:gap-8">
            <div class="text-right">
                <span class="text-[8px] md:text-[9px] text-gray-400 block uppercase font-bold tracking-widest leading-none">Total</span>
                <span id="cart-total-price" class="font-extrabold text-gray-900 text-lg md:text-2xl tracking-tighter">Rp0</span>
            </div>
            <button class="px-4 md:px-12 py-2.5 md:py-3.5 bg-[#00880d] text-white font-bold rounded-xl md:rounded-2xl hover:bg-[#00700a] transition-all shadow-lg active:scale-95 text-xs md:text-lg">
                Cek Keranjang
            </button>
        </div>
    </div>

    <div class="h-32"></div>

    <script>
        let cartState = { makanan: null, minuman: null };

        function addToCart(id, name, price, type) {
            cartState[type] = { id, name, price };
            updateUI();
        }

        function updateUI() {
            const modal = document.getElementById('cart-modal');
            const listText = document.getElementById('cart-items-list');
            const totalText = document.getElementById('cart-total-price');
            
            document.querySelectorAll('.menu-card').forEach(c => c.classList.remove('selected-card'));
            document.querySelectorAll('button i[id^="icon-"]').forEach(icon => {
                icon.className = 'fas fa-plus text-xs md:text-lg';
            });

            let total = 0;
            let names = [];

            Object.keys(cartState).forEach(type => {
                const item = cartState[type];
                if (item) {
                    total += item.price;
                    names.push(item.name);
                    
                    const card = document.getElementById(`card-${item.id}`);
                    if(card) card.classList.add('selected-card');
                    
                    const icon = document.getElementById(`icon-${item.id}`);
                    if(icon) icon.className = 'fas fa-check text-xs md:text-lg';
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