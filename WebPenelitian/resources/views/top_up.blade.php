<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Up E-Wallet - Go-Food</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
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
                <span class="text-[#00880d] font-bold text-lg md:text-xl tracking-tight">go-food.site</span>
            </div>
            <div class="relative border border-[#00880d] rounded-xl md:rounded-2xl px-3 py-1 text-right bg-white min-w-[100px] md:min-w-[130px]">
                <span class="font-bold absolute -top-2 right-4 bg-white px-2 text-[10px] md:text-[10px] text-[#00880d] uppercase">Saldo Anda</span>
                <span id="display-saldo-header" class="text-sm md:text-xl font-bold text-gray-800">Rp60,000</span>
            </div>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-4xl bg-white rounded-[2rem] shadow-sm p-8 md:p-12 border border-gray-100">
            <h1 class="text-xl md:text-2xl font-bold text-gray-900 mb-2">Top Up E-Wallet</h1>
            <p class="text-gray-600 font-semibold mb-8">Pilih Nominal</p>

            <!-- Grid Nominal -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                <button onclick="prosesTopUp(10000)" class="nominal-btn bg-white border border-gray-200 py-8 rounded-2xl shadow-sm hover:shadow-md hover:border-[#00880d] transition-all text-lg font-bold text-gray-800">
                    10.000
                </button>
                <button onclick="prosesTopUp(25000)" class="nominal-btn bg-white border border-gray-200 py-8 rounded-2xl shadow-sm hover:shadow-md hover:border-[#00880d] transition-all text-lg font-bold text-gray-800">
                    25.000
                </button>
                <button onclick="prosesTopUp(50000)" class="nominal-btn bg-white border border-gray-200 py-8 rounded-2xl shadow-sm hover:shadow-md hover:border-[#00880d] transition-all text-lg font-bold text-gray-800">
                    50.000
                </button>
                <button onclick="prosesTopUp(100000)" class="nominal-btn bg-white border border-gray-200 py-8 rounded-2xl shadow-sm hover:shadow-md hover:border-[#00880d] transition-all text-lg font-bold text-gray-800">
                    100.000
                </button>
            </div>
        </div>
    </main>

    <!-- POPUP BERHASIL -->
    <div id="success-modal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
        <div class="relative bg-white rounded-[2.5rem] p-10 w-full max-w-2xl shadow-2xl text-center animate-modal-up">
            <h2 class="text-xl md:text-3xl font-bold text-gray-900 mb-4 leading-tight">
                Top-up Anda berhasil. Ingin melanjutkan pembayaran?
            </h2>
            <p class="text-gray-500 text-sm md:text-base mb-10 font-medium">
                *klik tombol panah di pojok kiri atas untuk melanjutkan berbelanja
            </p>

            <div class="flex flex-col md:flex-row gap-4 justify-center">
                <button onclick="closeModal()" class="flex-1 py-4 border-2 border-red-500 text-red-500 font-bold rounded-2xl hover:bg-red-50 transition-colors text-lg">
                    Cancel
                </button>
                <button onclick="lanjutBayar()" class="flex-1 py-4 bg-[#00880d] text-white font-bold rounded-2xl hover:bg-[#00700a] transition-all shadow-lg text-lg">
                    Bayar & Proses Pengantaran
                </button>
            </div>
        </div>
    </div>

    <script>
        // Inisialisasi Saldo & Status Top Up
        let saldoSaatIni = parseInt(localStorage.getItem('gofood_saldo')) || 60000;
        // Cek apakah sudah pernah top up (mengambil nilai 'true' dari storage)
        let sudahTopUp = localStorage.getItem('gofood_already_topped_up') === 'true';

        window.addEventListener('pageshow', function() {
            renderTampilanTopUp();
        });

        function renderTampilanTopUp() {
            // Update Saldo Header
            const saldoHeader = document.getElementById('saldo-header');
            if(saldoHeader) saldoHeader.innerText = "Rp" + saldoSaatIni.toLocaleString('id-ID');

            // Jika sudah pernah top up, kita beri visual bahwa tombol tidak bisa diklik
            if (sudahTopUp) {
                const buttons = document.querySelectorAll('.nominal-btn');
                buttons.forEach(btn => {
                    btn.classList.add('opacity-50', 'cursor-not-allowed', 'grayscale');
                    btn.onclick = function() { 
                        alert("Maaf, Anda hanya diperbolehkan melakukan top up satu kali saja."); 
                    };
                });

                // Opsional: Tambahkan pesan peringatan di bawah judul
                const subTitle = document.querySelector('p.text-gray-600');
                if(subTitle) subTitle.innerHTML = "Pilih Nominal <span class='text-red-500 font-bold'>(Batas Top Up Tercapai)</span>";
            }
        }

        function prosesTopUp(nominal) {
            if (localStorage.getItem('gofood_already_topped_up') === 'true') {
                alert("Batas top up hanya satu kali!");
                return;
            }

            // 1. Update Saldo di Storage
            saldoSaatIni += nominal;
            localStorage.setItem('gofood_saldo', saldoSaatIni);

            // 2. Set penanda bahwa user SUDAH top up
            localStorage.setItem('gofood_already_topped_up', 'true');
            sudahTopUp = true; // Update variabel lokal

            localStorage.setItem('top_up_nominal', nominal);

            // 2. Update Tampilan Header
            document.getElementById('display-saldo-header').innerText = "Rp" + saldoSaatIni.toLocaleString('id-ID');

            // 3. Munculkan Modal
            document.getElementById('success-modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('success-modal').classList.add('hidden');
        }

        function lanjutBayar() {
            // Kembali ke halaman pembayaran
            window.location.href = "/pembayaran";
        }
    </script>
</body>
</html>