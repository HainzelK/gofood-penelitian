<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ringkasan Pembayaran - Go-Food</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
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
            <span class="text-[#00880d] font-bold text-lg md:text-xl tracking-tight text-center flex-1 md:flex-none">go-food.site</span>
            <div class="relative border border-[#00880d] rounded-xl md:rounded-2xl px-3 py-1 text-right bg-white min-w-[100px] md:min-w-[130px]">
                <span class="font-bold absolute -top-2 right-4 bg-white px-2 text-[10px] md:text-[10px] text-[#00880d] uppercase">Saldo Anda</span>
                <span id="display-saldo-header" class="text-sm md:text-xl font-bold text-gray-800">Rp60,000</span>
            </div>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center px-4 py-10">
        <!-- Box Ringkasan -->
        <div class="w-full max-w-2xl bg-white rounded-[2rem] shadow-xl p-8 md:p-12 border border-gray-100">
            <h1 class="text-xl md:text-2xl font-extrabold text-gray-900 mb-8">Ringkasan Pembayaran</h1>

            <div class="space-y-4">
                <!-- Subtotal Harga Makanan -->
                <div class="flex justify-between items-start">
                    <span class="text-gray-600 font-semibold text-base md:text-lg">Harga</span>
                    <span id="display-subtotal" class="text-gray-900 font-bold text-base md:text-lg">0</span>
                </div>
                
                <!-- List Item Dinamis -->
                <div id="item-list" class="pl-4 space-y-2 text-gray-500 text-sm md:text-base italic">
                    <!-- Diisi oleh JS -->
                </div>

                <!-- Pajak -->
                <div class="flex justify-between py-2">
                    <span class="text-gray-600 font-semibold">Pajak Restoran (5%)</span>
                    <span id="display-tax" class="text-gray-900 font-bold">0</span>
                </div>

                <!-- Biaya Kirim -->
                <div class="flex justify-between py-2 border-b border-gray-300 pb-6">
                    <span class="text-gray-600 font-semibold">Biaya Pengiriman dan Pengemasan</span>
                    <span class="text-gray-900 font-bold">15,000</span>
                </div>

                <!-- Total Akhir -->
                <div class="flex justify-between items-center pt-4">
                    <span class="text-xl md:text-2xl font-extrabold text-gray-900">Total Harga</span>
                    <span id="display-total-akhir" class="text-xl md:text-2xl font-extrabold text-gray-900">0</span>
                </div>
            </div>

            <!-- Tombol Bayar -->
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
                <!-- Tombol Cancel tetap -->
                <button onclick="toggleModal(false)" class="flex-1 py-3 border-2 border-red-500 text-red-500 font-bold rounded-xl md:rounded-2xl hover:bg-red-50 transition-colors">
                    Cancel
                </button>

                <!-- WADAH TOMBOL DINAMIS (Bayar atau Top Up) -->
                <div id="modal-action-button" class="flex-1">
                    <!-- Akan diisi oleh JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // 1. Jalankan fungsi saat halaman selesai dimuat
        document.addEventListener('DOMContentLoaded', function() {
            renderRingkasan();
        });

        function renderRingkasan() {
            // --- A. AMBIL DATA ---
            const rawData = localStorage.getItem('gofood_cart');
            const saldoSaatIni = parseInt(localStorage.getItem('gofood_saldo')) || 60000;

            // Update tampilan saldo di header
            const saldoHeader = document.getElementById('display-saldo-header');
            if(saldoHeader) saldoHeader.innerText = "Rp" + saldoSaatIni.toLocaleString('id-ID');

            // Validasi jika keranjang kosong
            if (!rawData || rawData === '{"makanan":null,"minuman":null}') {
                alert("Keranjang kosong! Anda akan dikembalikan ke halaman menu.");
                window.location.href = "/"; 
                return;
            }

            const cart = JSON.parse(rawData);

            // --- B. HITUNG NILAI ---
            let subtotal = 0;
            const listContainer = document.getElementById('item-list');
            listContainer.innerHTML = ''; 

            Object.keys(cart).forEach(key => {
                const item = cart[key];
                if (item && item.name && item.price) {
                    subtotal += item.price;
                    listContainer.innerHTML += `
                        <div class="flex justify-between py-1">
                            <span>• ${item.name}</span>
                            <span>${item.price.toLocaleString('id-ID')}</span>
                        </div>
                    `;
                }
            });

            const tax = subtotal * 0.05;
            const shipping = 15000;
            const totalAkhir = subtotal + tax + shipping;

            // Simpan ke variabel global agar bisa diakses fungsi prosesBayar
            window.currentTotal = totalAkhir;

            // --- C. UPDATE TAMPILAN HARGA ---
            document.getElementById('display-subtotal').innerText = subtotal.toLocaleString('id-ID');
            document.getElementById('display-tax').innerText = tax.toLocaleString('id-ID');
            document.getElementById('display-total-akhir').innerText = totalAkhir.toLocaleString('id-ID');

            const modalTotalText = document.getElementById('modal-total-text');
            if(modalTotalText) {
                modalTotalText.innerText = "Rp. " + totalAkhir.toLocaleString('id-ID');
            }

            // --- D. LOGIKA TOMBOL (BAYAR vs TOP UP) ---
            const btnContainer = document.getElementById('modal-action-button');
            if (!btnContainer) return;

            console.log("Saldo saat ini:", saldoSaatIni);
            console.log("Total akhir:", totalAkhir );
            if (saldoSaatIni < totalAkhir) {
                // Jika saldo kurang, tampilkan tombol Top Up
                btnContainer.innerHTML = `
                    <button onclick="window.location.href='/topup'" class="bg-[#ffcc00] hover:bg-[#e6b800] text-black font-extrabold py-3 px-8 rounded-xl shadow-lg transition-all w-full md:w-auto">
                        Top Up Saldo
                    </button>
                `;
            } else {
                // Jika saldo cukup, tampilkan tombol Bayar
                btnContainer.innerHTML = `
                    <button onclick="toggleModal(true)" class="bg-[#00880d] hover:bg-[#00700a] text-white font-extrabold py-3 px-8 rounded-xl shadow-lg transition-all w-full md:w-auto">
                        Bayar & Proses Pengantaran
                    </button>
                `;
            }
        }

        function toggleModal(show) {
            const modal = document.getElementById('payment-modal');
            if(modal) modal.classList.toggle('hidden', !show);
        }

        function prosesBayar() {
            // Ambil saldo terbaru dari storage
            let saldoSaatIni = parseInt(localStorage.getItem('gofood_saldo')) || 60000;

            if (window.currentTotal > saldoSaatIni) {
                alert("Maaf, saldo Anda tidak cukup!");
                window.location.href = "/topup";
            } else {
                // Potong Saldo
                const sisaSaldo = saldoSaatIni - window.currentTotal;
                localStorage.setItem('gofood_saldo', sisaSaldo);

                alert("Pembayaran Berhasil! Pesanan sedang diproses.");
                localStorage.removeItem('gofood_cart'); // Bersihkan keranjang
                window.location.href = "/success-page"; // Sesuaikan route sukses Anda
            }
        }
    </script>
</body>
</html>