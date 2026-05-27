<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ringkasan Pembayaran - Go-Food</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f2f8f2] min-h-screen flex flex-col">

    @php
        $dataPendaftar = session('data_pendaftar');
        $plotting = $dataPendaftar['plotting'] ?? 'IRPR';
        
        $plottingConfig = [
            'plotting_code' => $plotting,
            'pajak_rate' => in_array($plotting, ['ITPT', 'IRPT']) ? 0.20 : 0.05,
            'insentif_rate' => in_array($plotting, ['ITPT', 'ITPR']) ? 0.20 : 0.05,
        ];
    @endphp

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

    <main class="flex-grow flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-2xl bg-white rounded-[2rem] shadow-xl p-8 md:p-12 border border-gray-100">
            <h1 class="text-xl md:text-2xl font-extrabold text-gray-900 mb-8">Ringkasan Pembayaran</h1>

            <div class="space-y-4">
                <div class="flex justify-between items-start">
                    <span class="text-gray-600 font-semibold text-base md:text-lg">Harga</span>
                    <span id="display-subtotal" class="text-gray-900 font-bold text-base md:text-lg">0</span>
                </div>
                
                <div id="item-list" class="pl-4 space-y-2 text-gray-500 text-sm md:text-base italic"></div>

                <!-- Kebijakan: Insentif (HF) atau Pajak (TGGL) -->
                <div id="row-kebijakan" class="flex justify-between py-2 hidden">
                    <span id="label-kebijakan" class="text-gray-600 font-semibold"></span>
                    <span id="display-kebijakan-val" class="text-gray-900 font-bold">0</span>
                </div>

                <!-- Biaya Kirim -->
                <div class="flex justify-between py-2 border-b border-gray-300 pb-6">
                    <span class="text-gray-600 font-semibold">Biaya Pengiriman dan Pengemasan</span>
                    <span class="text-gray-900 font-bold">15.000</span>
                </div>

                <!-- Total Akhir -->
                <div class="flex justify-between items-center pt-4">
                    <span class="text-xl md:text-2xl font-extrabold text-gray-900">Total Harga</span>
                    <span id="display-total-akhir" class="text-xl md:text-2xl font-extrabold text-[#00880d]">0</span>
                </div>
            </div>

            <div class="mt-10 flex justify-end">
                <button onclick="toggleModal(true)" class="bg-[#00880d] hover:bg-[#00700a] text-white font-extrabold py-3 px-8 rounded-xl md:rounded-2xl text-base md:text-lg shadow-lg active:scale-95 transition-all">
                    Bayar & Proses Pengantaran
                </button>
            </div>
        </div>
    </main>

    <!-- POPUP KONFIRMASI -->
    <div id="payment-modal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="toggleModal(false)"></div>
        <div class="relative bg-white rounded-[2rem] md:rounded-[2.5rem] p-8 md:p-12 w-full max-w-lg shadow-2xl text-center">
            <h2 class="text-lg md:text-2xl font-bold text-gray-900 mb-8 leading-relaxed">
                Total belanja Anda adalah sebesar <br>
                <span id="modal-total-text" class="text-xl md:text-3xl font-extrabold">Rp0</span>
            </h2>
            <div class="flex flex-row gap-4 justify-center">
                <button onclick="toggleModal(false)" class="flex-1 py-3 border-2 border-red-500 text-red-500 font-bold rounded-xl md:rounded-2xl hover:bg-red-50 transition-colors">
                    Cancel
                </button>
                <div id="modal-action-button" class="flex-1">
                    <!-- Diisi dinamis: Bayar atau Top Up -->
                </div>
            </div>
        </div>
    </div>

    <script>
        const PLOTTING_DATA = @json($plottingConfig);
        const CONFIG = { SHIPPING: 15000 };

        function formatRupiah(amount) {
            return Math.round(amount).toLocaleString('id-ID');
        }

        // Helper: Konversi milidetik ke format HH:MM:SS sesuai snippet 1
        function formatElapsedTime(ms) {
            if (!ms || ms <= 0) return '00:00:00';
            let totalSeconds = Math.floor(ms / 1000);
            let hours = Math.floor(totalSeconds / 3600);
            let minutes = Math.floor((totalSeconds % 3600) / 60);
            let seconds = totalSeconds % 60;
            return [
                String(hours).padStart(2, '0'),
                String(minutes).padStart(2, '0'),
                String(seconds).padStart(2, '0')
            ].join(':');
        }

        function calculateFoodAdjustment(category, price) {
            const { pajak_rate, insentif_rate } = PLOTTING_DATA;
            if (category === 'HF') {
                return {
                    adjustment: -(price * insentif_rate),
                    label: `Insentif Menu Sehat (-${insentif_rate * 100}%)`,
                    type: 'discount'
                };
            } else if (category === 'TGGL') {
                return {
                    adjustment: price * pajak_rate,
                    label: `Pajak Kebijakan (+${pajak_rate * 100}%)`,
                    type: 'tax'
                };
            }
            return { adjustment: 0, label: '', type: 'none' };
        }

        document.addEventListener('DOMContentLoaded', renderRingkasan);

        function renderRingkasan() {
            const rawData = localStorage.getItem('gofood_cart');
            const saldoSaatIni = parseInt(localStorage.getItem('gofood_saldo')) || 60000;
            
            document.getElementById('display-saldo-header').innerText = "Rp" + formatRupiah(saldoSaatIni);

            if (!rawData || rawData === '{"makanan":null,"minuman":null}') { 
                alert("Keranjang kosong!");
                window.location.href = "/"; 
                return; 
            }
            
            const cart = JSON.parse(rawData);
            let subtotal = 0, foodAdjustment = 0, kebijakanLabel = "";
            const listContainer = document.getElementById('item-list');
            listContainer.innerHTML = ''; 

            Object.keys(cart).forEach(key => {
                const item = cart[key];
                if (!item || !item.price) return;

                subtotal += item.price;
                listContainer.innerHTML += `
                    <div class="flex justify-between py-1">
                        <span>• ${item.name}</span>
                        <span>${formatRupiah(item.price)}</span>
                    </div>
                `;

                if (key === 'makanan') {
                    // Logic penentuan HF/TGGL berdasarkan ID Menu (Sesuai database mapping)
                    const hfMenuIds = [1, 2, 3, 6, 7, 8, 11, 12, 13];
                    const category = hfMenuIds.includes(parseInt(item.id)) ? 'HF' : 'TGGL';
                    
                    const result = calculateFoodAdjustment(category, item.price);
                    foodAdjustment = result.adjustment;
                    kebijakanLabel = result.label;
                }
            });

            // Update UI Baris Kebijakan
            const rowKebijakan = document.getElementById('row-kebijakan');
            if (foodAdjustment !== 0) {
                rowKebijakan.classList.remove('hidden');
                document.getElementById('label-kebijakan').innerText = kebijakanLabel;
                const valEl = document.getElementById('display-kebijakan-val');
                valEl.innerText = (foodAdjustment > 0 ? "+" : "") + formatRupiah(foodAdjustment);
                valEl.className = `font-bold ${foodAdjustment < 0 ? 'text-green-600' : 'text-red-600'}`;
            }

            const totalAkhir = subtotal + foodAdjustment + CONFIG.SHIPPING;

            // Simpan Global untuk prosesBayar
            window.currentTotal = Math.round(totalAkhir);
            window.currentFoodAdjustment = Math.round(foodAdjustment);

            document.getElementById('display-subtotal').innerText = formatRupiah(subtotal);
            document.getElementById('display-total-akhir').innerText = formatRupiah(totalAkhir);
            document.getElementById('modal-total-text').innerText = "Rp" + formatRupiah(totalAkhir);

            const btnContainer = document.getElementById('modal-action-button');
            if (saldoSaatIni < totalAkhir) {
                btnContainer.innerHTML = `<button onclick="window.location.href='/topup'" class="bg-[#ffcc00] hover:bg-[#e6b800] text-black font-extrabold py-3 px-8 rounded-xl shadow-lg w-full">Top Up Saldo</button>`;
            } else {
                btnContainer.innerHTML = `<button onclick="prosesBayar()" class="bg-[#00880d] hover:bg-[#00700a] text-white font-extrabold py-3 px-8 rounded-xl shadow-lg w-full">Bayar Sekarang</button>`;
            }
        }

        function toggleModal(show) {
            document.getElementById('payment-modal').classList.toggle('hidden', !show);
        }

        function prosesBayar() {
            const saldoSaatIni = parseInt(localStorage.getItem('gofood_saldo')) || 60000;

            if (window.currentTotal > saldoSaatIni) {
                alert("Maaf, saldo Anda tidak cukup!");
                window.location.href = "/topup";
                return;
            }

            // Ambil data pendukung dari localStorage (Snippet 1)
            const cart = JSON.parse(localStorage.getItem('gofood_cart')) || {};
            const topUpNominal = parseInt(localStorage.getItem('top_up_nominal')) || 0;
            const now = Date.now();
            const timeCasePresStart = parseInt(localStorage.getItem('time_case_pres_start')) || now;
            const timeAllStart = parseInt(localStorage.getItem('time_all_start')) || now;

            // Susun Payload Gabungan
            const payload = {
                saldo: saldoSaatIni,
                menu_makanan: cart.makanan ? parseInt(cart.makanan.id) : 0,
                menu_minuman: cart.minuman ? parseInt(cart.minuman.id) : 0,
                subsidi_insentif: window.currentFoodAdjustment < 0 ? Math.abs(window.currentFoodAdjustment) : 0,
                pajak: window.currentFoodAdjustment > 0 ? window.currentFoodAdjustment : 0,
                total: window.currentTotal,
                top_up: topUpNominal,
                time_case_pres: formatElapsedTime(now - timeCasePresStart),
                time_all: formatElapsedTime(now - timeAllStart),
                plotting: PLOTTING_DATA.plotting_code
            };

            // Kirim AJAX ke server
            fetch('/proses-bayar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: JSON.stringify(payload),
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Potong Saldo & Bersihkan Cart (Snippet 1)
                    localStorage.setItem('gofood_saldo', saldoSaatIni - window.currentTotal);
                    localStorage.removeItem('gofood_cart');
                    
                    // alert("Pembayaran Berhasil! Pesanan sedang diproses.");
                    window.location.href = "/thankyou";
                } else {
                    alert("Gagal: " + (data.message || 'Terjadi kesalahan.'));
                }
            })
            .catch(err => {
                console.error('Error:', err);
                alert("Terjadi kesalahan jaringan.");
            });
        }
    </script>
</body>
</html>