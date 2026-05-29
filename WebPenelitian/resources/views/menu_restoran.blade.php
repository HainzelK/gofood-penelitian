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
    <header class="bg-white py-3 px-4 md:px-6 shadow-sm border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="w-12 md:w-24">
                <a href="javascript:history.back()" class="inline-flex items-center justify-center w-10 h-10 bg-[#ffcc00] rounded-xl shadow-sm hover:bg-[#e6b800] transition-transform active:scale-95 text-black">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <span class="text-[#00880d] font-bold text-lg md:text-xl tracking-tight text-center flex-1 md:flex-none">go-food.site</span>
            <div class="relative border border-[#00880d] rounded-xl md:rounded-2xl px-3 py-1 text-right bg-white min-w-[100px] md:min-w-[130px]">
                <span class="font-bold absolute -top-2 right-4 bg-white px-2 text-[10px] md:text-[10px] text-[#00880d] uppercase">Saldo Anda</span>
                <span id="display-saldo-header" class="text-sm md:text-xl font-bold text-gray-800">Rp60,000</span>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto w-full px-4 py-6 md:py-10">
        
        <!-- PROFIL RESTORAN -->
        <section class="flex flex-row items-center gap-4 md:gap-10 mb-10 md:mb-14">
            <div class="w-28 h-20 md:w-80 md:h-52 rounded-2xl md:rounded-[2.5rem] overflow-hidden shadow-lg border-2 border-white shrink-0">
                <img src="{{ asset('storage/' . str_replace([' '], '', ($restoran->Nama)) . '.png') }}" 
                     alt="{{ $restoran->Nama }}" 
                     class="w-full h-full object-cover"
                     onerror="this.src='https://via.placeholder.com/600x400?text=Restoran'">
            </div>
            
            <div class="flex-1 text-left">
                <h1 class="text-xl md:text-5xl font-extrabold text-gray-900 mb-1 tracking-tight">
                    {{ $restoran->Nama }}
                </h1>
                <p class="text-[10px] md:text-xl text-gray-500 font-medium italic line-clamp-1 md:line-clamp-none">
                    {{ $restoran->Ket ?? 'Indonesian Comfort Food' }}
                </p>
                <div class="flex items-center gap-2 md:gap-4 mt-2 md:mt-5 text-[10px] md:text-sm font-bold">
                    <span class="flex items-center gap-1 bg-yellow-50 text-yellow-700 px-2 py-0.5 md:px-3 md:py-1 rounded-full shadow-sm">
                        <i class="fas fa-star text-[8px] md:text-xs"></i> 4.8
                    </span>
                    <span class="text-gray-300">•</span>
                    <span class="text-gray-400">Indonesian Food</span>
                </div>
            </div>
        </section>

        <!-- Judul Daftar Menu -->
        <div class="flex items-center gap-3 mb-6">
            <div class="h-6 w-1 bg-[#00880d] rounded-full"></div>
            <h2 class="text-sm md:text-xl font-extrabold text-gray-800 uppercase tracking-widest">Daftar Menu</h2>
        </div>

        <!-- Grid Menu -->
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-10">
            @forelse($menuItems as $menu)
            @php $kat = strtolower($menu->Jenis); @endphp
            
            <div id="card-{{ $menu->idmenu }}" class="menu-card bg-white rounded-[1.5rem] md:rounded-[2.8rem] shadow-sm p-3 md:p-6 border-2 border-transparent transition-all flex flex-col h-full group relative">
                <div class="aspect-square md:aspect-video w-full rounded-xl md:rounded-[2.2rem] overflow-hidden mb-3 md:mb-5 bg-gray-50">
                    <img src="{{ asset('storage/' . str_replace([' ', '+'], '_', strtolower($menu->NamaMenu)) . '.png') }}" 
                         alt="{{ $menu->NamaMenu }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                </div>

                <div class="flex-grow flex flex-col justify-between">
                    <h3 class="text-[11px] md:text-lg font-bold text-gray-900 mb-2 leading-tight line-clamp-2">{{ $menu->NamaMenu }}</h3>
                    <div class="flex flex-row justify-between items-center">
                        <span class="text-gray-900 font-extrabold text-[11px] md:text-xl">Rp{{ number_format($menu->Harga, 0, ',', '.') }}</span>
                        
                        <button id="btn-{{ $menu->idmenu }}" 
                                onclick="addToCart('{{ $menu->idmenu }}', '{{ $menu->NamaMenu }}', {{ $menu->Harga }}, '{{ $kat }}')" 
                                class="w-7 h-7 md:w-12 md:h-12 bg-[#00880d] text-white rounded-lg md:rounded-2xl flex items-center justify-center hover:bg-[#00700a] shadow-md active:scale-90 transition-all">
                            <i id="icon-{{ $menu->idmenu }}" class="fas fa-plus text-[10px] md:text-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
            @empty
                <p class="col-span-full text-center py-20 text-gray-400 italic">Menu belum tersedia.</p>
            @endforelse
        </div>
    </main>

<!-- FLOATING CART BAR -->
    <div id="cart-modal-bar" class="hidden fixed bottom-6 md:bottom-10 left-1/2 -translate-x-1/2 w-[95%] max-w-4xl bg-[#fdfde1] rounded-[1.5rem] md:rounded-[2.5rem] p-2 md:p-3 shadow-2xl z-[100] border border-yellow-200 items-center animate-cart flex flex-row">
        
        <!-- BAGIAN 1: INFO KERANJANG (Berhenti sebelum garis merah pertama) -->
        <!-- flex-1 dan min-w-0 sangat penting agar truncate bekerja -->
        <div class="flex items-center gap-2 md:gap-3 flex-1 min-w-0 pr-3 ">
            <div class="w-10 h-10 md:w-14 md:h-14 bg-white rounded-xl md:rounded-2xl flex-shrink-0 flex items-center justify-center shadow-sm text-[#00880d]">
                <i class="fas fa-shopping-basket text-lg md:text-2xl"></i>
            </div>
            <div class="flex flex-col min-w-0">
                <span class="font-bold text-gray-900 text-[13px] md:text-lg leading-tight">Keranjang</span>
                <!-- ID ini akan menampilkan item dan otomatis terpotong (truncate) -->
                <span id="cart-items-list" class="text-[10px] md:text-[12px] text-gray-500 truncate italic block">Belum ada pesanan</span>
            </div>
        </div>

        <!-- BAGIAN 2: HARGA (Berhenti sebelum garis merah kedua) -->
        <!-- Lebar diatur tetap agar konsisten di tengah -->
        <div class="w-24 md:w-40 flex-shrink-0 px-2 text-center">
            <span id="cart-total-price" class="font-extrabold text-gray-900 text-[14px] md:text-2xl tracking-tighter block truncate">Rp0</span>
        </div>

        <!-- BAGIAN 3: TOMBOL -->
        <div class="flex-shrink-0 pl-2">
            <button onclick="openCheckoutModal()" class="px-4 md:px-10 py-3 md:py-4 bg-[#00880d] text-white font-bold rounded-xl md:rounded-[1.8rem] hover:bg-[#00700a] text-[11px] md:text-lg shadow-md active:scale-95 transition-all whitespace-nowrap">
                Cek Keranjang
            </button>
        </div>
    </div>

    
    <!-- CHECKOUT MODAL OVERLAY -->
    <div id="modal-overlay" class="hidden fixed inset-0 bg-black/60 z-[110] backdrop-blur-sm transition-opacity"></div>

    <!-- CHECKOUT MODAL CONTENT -->
    <!-- 
         Mobile: items-end (aligns to bottom)
         Desktop: md:items-center (aligns to center)
         justify-center: Always centers horizontally
    -->
    <div id="checkout-popup" class="hidden fixed inset-0 z-[120] flex items-end md:items-center justify-center pointer-events-none">
        
        <!-- Modal Body -->
        <!-- w-full ensures it takes width on mobile, max-w-md limits it on desktop -->
        <div class="w-full max-w-md bg-white rounded-t-[2.5rem] md:rounded-[2.5rem] shadow-2xl overflow-hidden animate-modal-up flex flex-col max-h-[90vh] pointer-events-auto relative">
            
            <div class="p-6 md:p-10 overflow-y-auto">
                <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-6">Keranjang Saya</h2>

                <!-- List Item di Modal -->
                <div id="modal-items-container" class="space-y-6 mb-8">
                    <!-- Diisi via JS -->
                </div>

                <!-- Total -->
                <div class="flex justify-between items-center border-t border-gray-100 pt-5 mb-8">
                    <span class="text-gray-500 font-bold">Total</span>
                    <span id="modal-total-display" class="text-xl md:text-2xl font-extrabold text-gray-900 tracking-tighter">Rp0</span>
                </div>

                <!-- Action -->
                <div class="sticky bottom-0 bg-white pb-2">
                    <button onclick="confirmOrder()" class="w-full py-3 md:py-4 bg-[#00880d] text-white font-bold rounded-2xl hover:bg-[#00700a] shadow-lg text-base md:text-lg active:scale-95 transition-all mb-3">
                        Bayar Pesanan
                    </button>
                    <button onclick="closeCheckoutModal()" class="w-full py-2 text-gray-400 font-bold text-sm hover:text-gray-600 transition-colors">
                        Kembali
                    </button>
                </div>
            </div>
            
        </div>
    </div>

    <!-- ALERT MODAL OVERLAY -->
    <div id="alert-modal-overlay" class="hidden fixed inset-0 bg-black/60 z-[130] backdrop-blur-sm transition-opacity" onclick="closeAlertModal()"></div>

    <!-- ALERT MODAL CONTENT -->
    <div id="alert-popup" class="hidden fixed inset-0 z-[140] flex items-center justify-center pointer-events-none p-4">
        <div class="w-full max-w-sm bg-white rounded-[2rem] shadow-2xl p-6 md:p-8 flex flex-col items-center pointer-events-auto text-center transform scale-95 transition-transform duration-200">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-4 text-red-500 text-3xl">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Peringatan</h3>
            <p class="text-gray-600 mb-6 text-sm md:text-base">Silakan pilih makanan terlebih dahulu!</p>
            <button onclick="closeAlertModal()" class="w-full py-3 bg-[#00880d] text-white font-bold rounded-xl hover:bg-[#00700a] transition-colors active:scale-95 shadow-md">
                Mengerti
            </button>
        </div>
    </div>

<div class="h-24 md:h-32"></div>

    <script>
        window.addEventListener('pageshow', function(event) {
            updateHeaderSaldo();
        });

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
        }

        // 1. AMBIL DATA DARI STORAGE SAAT HALAMAN DIBUKA (Agar tidak hilang saat refresh)
        let cartState = JSON.parse(localStorage.getItem('gofood_cart')) || { makanan: null, minuman: null };
        
        // 2. JALANKAN UPDATE UI SEGERA SAAT HALAMAN DIMUAT
        window.onload = function() {
            updateUI();
        };
    
        function addToCart(id, name, price, type) {
            cartState[type] = { id, name, price };
            
            // SIMPAN KE STORAGE SETIAP KALI ITEM DITAMBAHKAN
            localStorage.setItem('gofood_cart', JSON.stringify(cartState));
            
            updateUI();
        }

        function updateUI() {
            const bar = document.getElementById('cart-modal-bar');
            const listText = document.getElementById('cart-items-list');
            const totalText = document.getElementById('cart-total-price');
            
            // Reset semua tampilan kartu dulu
            document.querySelectorAll('.menu-card').forEach(c => c.classList.remove('selected-card'));
            document.querySelectorAll('button i[id^="icon-"]').forEach(icon => {
                icon.className = 'fas fa-plus text-[10px] md:text-lg';
            });

            let total = 0;
            let names = [];

            Object.keys(cartState).forEach(type => {
                const item = cartState[type];
                if (item) {
                    total += item.price;
                    names.push(item.name);

                    // Beri tanda centang dan border hijau pada item yang ada di storage
                    const card = document.getElementById(`card-${item.id}`);
                    if(card) card.classList.add('selected-card');
                    const icon = document.getElementById(`icon-${item.id}`);
                    if(icon) icon.className = 'fas fa-check text-[10px] md:text-lg';
                }
            });

            if (names.length > 0) {
                bar.classList.remove('hidden');
                bar.classList.add('flex');
                listText.innerText = names.join(' + ');
                totalText.innerText = `Rp${total.toLocaleString('id-ID')}`;
            } else {
                bar.classList.add('hidden');
            }
        }

        // MODAL LOGIC
        function openCheckoutModal() {
            const container = document.getElementById('modal-items-container');
            const totalDisplay = document.getElementById('modal-total-display');
            container.innerHTML = '';
            let total = 0;

            Object.keys(cartState).forEach(type => {
                const item = cartState[type];
                if (item) {
                    total += item.price;
                    // Format nama file gambar sama dengan di list
                    const imgName = item.name.toLowerCase().replace(/[ +]/g, '_') + '.png';
                    
                    container.innerHTML += `
                        <div class="flex items-center gap-4">
                            <img src="/storage/${imgName}" class="w-16 h-14 md:w-20 md:h-16 object-cover rounded-xl bg-gray-50 border border-gray-100 shadow-sm" onerror="this.src='https://via.placeholder.com/100?text=Food'">
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-800 text-sm md:text-base leading-tight">${item.name}</h4>
                                <p class="text-[10px] md:text-xs text-gray-400 font-bold mt-1">x1</p>
                            </div>
                            <div class="text-right">
                                <button onclick="removeItem('${type}')" class="flex items-center gap-1 text-[10px] md:text-xs font-bold text-red-500 border border-red-200 px-2 py-1.5 rounded-xl hover:bg-red-50 mb-1 transition-all">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                                <p class="font-extrabold text-gray-900 text-sm md:text-base">Rp${item.price.toLocaleString('id-ID')}</p>
                            </div>
                        </div>
                    `;
                }
            });

            totalDisplay.innerText = `Rp${total.toLocaleString('id-ID')}`;
            document.getElementById('modal-overlay').classList.remove('hidden');
            document.getElementById('checkout-popup').classList.remove('hidden');
        }

        function closeCheckoutModal() {
            document.getElementById('modal-overlay').classList.add('hidden');
            document.getElementById('checkout-popup').classList.add('hidden');
        }

        function openAlertModal() {
            document.getElementById('alert-modal-overlay').classList.remove('hidden');
            document.getElementById('alert-popup').classList.remove('hidden');
            setTimeout(() => {
                document.getElementById('alert-popup').children[0].classList.remove('scale-95');
                document.getElementById('alert-popup').children[0].classList.add('scale-100');
            }, 10);
        }

        function closeAlertModal() {
            document.getElementById('alert-modal-overlay').classList.add('hidden');
            document.getElementById('alert-popup').classList.add('hidden');
            document.getElementById('alert-popup').children[0].classList.remove('scale-100');
            document.getElementById('alert-popup').children[0].classList.add('scale-95');
        }

        function removeItem(type) {
            cartState[type] = null;
            updateUI();
            
            // Cek jika keranjang kosong total, tutup modal
            if (!cartState.makanan && !cartState.minuman) {
                closeCheckoutModal();
            } else {
                openCheckoutModal(); // Refresh isi modal
            }
        }

        function back() {
            localStorage.removeItem('gofood_cart');
        }

        function confirmOrder() {
            // 1. Cek apakah ada data di cartState
            console.log("Data yang akan disimpan:", cartState);
                
            if (!cartState.makanan) {
                closeCheckoutModal();
                openAlertModal();
                return;
            }
        
            // 2. Simpan ke LocalStorage dengan nama key 'gofood_cart'
            localStorage.setItem('gofood_cart', JSON.stringify(cartState));
        
            // 3. Verifikasi sebentar apakah sudah tersimpan (opsional untuk debug)
            const check = localStorage.getItem('gofood_cart');
            console.log("Data di storage saat ini:", check);
        
            // 4. Pindah ke route /pembayaran
            // Gunakan URL lengkap jika perlu, atau /pembayaran sesuai route Laravel Anda
            window.location.href = "/pembayaran"; 
        }

        document.getElementById('modal-overlay').onclick = closeCheckoutModal;
    </script>
</body>
</html>