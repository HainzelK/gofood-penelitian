<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjelasan & Persetujuan Responden</title>
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
    <header class="bg-white py-3 px-4 md:px-6 shadow-sm border-b border-gray-100 sticky top-0 z-50 flex-shrink-0">
        <div class="max-w-7xl mx-auto flex justify-between items-center w-full">
            <div class="w-12 md:w-24 h-10">
                <!-- Tombol back dihapus, tinggi dipertahankan -->
            </div>
            <div class="flex items-center justify-center gap-2 flex-1 md:flex-none">
                <span class="text-[#00880d] font-bold text-lg md:text-xl tracking-tight">go-food.site</span>
            </div>
            <div class="min-w-[100px] md:min-w-[130px]"></div>
        </div>
    </header>

    <!-- Main Content Container -->
    <main class="flex-grow flex items-center justify-center p-4 md:p-8">
        
        <!-- Card: Responsif (Lebar penuh di HP, terbatas di PC) -->
        <div class="bg-white w-full max-w-2xl rounded-[2.5rem] shadow-xl p-8 md:p-14 transition-all">
            
            <!-- Judul: Ukuran teks menyesuaikan layar -->
            <h1 class="text-xl md:text-3xl font-bold text-gray-900 mb-6 md:mb-10 leading-tight">
                Penjelasan & Persetujuan Responden
            </h1>

            <!-- List Poin: Spacing lebih rapat di HP -->
            <div class="space-y-4 md:space-y-6 text-gray-700 leading-relaxed text-[14px] md:text-[16px]">
                <div class="flex gap-3">
                    <span class="font-semibold text-gray-900">1.</span>
                    <p>Penelitian ini bertujuan untuk menguji efektivitas intervensi fiskal berbasis harga, melalui tarif pajak dan insentif pajak dalam kaitannya dengan keputusan konsumsi masyarakat melalui layanan pengantaran makanan online.</p>
                </div>

                <div class="flex gap-3">
                    <span class="font-semibold text-gray-900">2.</span>
                    <p>Saya memahami bahwa partisipasi saya bersifat sukarela.</p>
                </div>

                <div class="flex gap-3">
                    <span class="font-semibold text-gray-900">3.</span>
                    <p>Data yang diperoleh dari penelitian ini dijaga kerahasiaannya dan hanya digunakan untuk kepentingan ilmiah.</p>
                </div>
            </div>

            <!-- Teks Persetujuan -->
            <p class="mt-8 md:mt-12 text-[13px] md:text-[15px] text-gray-800 font-medium">
                Dengan mengklik <span class="font-bold">"Setuju & Lanjutkan"</span>, saya telah menyetujui pertimbangan-pertimbangan di atas dan bersedia untuk melanjutkan proses penelitian ini sampai dengan selesai.
            </p>

            <!-- Buttons: Stack di Mobile, Side-by-side di Desktop -->
            <div class="mt-8 md:mt-12 flex flex-col-reverse md:flex-row gap-4 justify-center">
                <a href="{{ route('thankyou') }}" class="w-full md:w-auto px-10 py-3.5 border-2 border-[#b54a3a] text-[#b54a3a] font-bold rounded-2xl hover:bg-red-50 transition-colors text-center text-[15px]">
                    Tidak Setuju
                </a>
                
                <form method="POST" action="{{ route('consent.accept') }}" class="w-full md:w-auto">
                    @csrf
                    <button type="submit" class="w-full px-10 py-3.5 bg-[#00880d] text-white font-bold rounded-2xl hover:bg-[#00700a] shadow-lg shadow-green-100 transition-all text-center text-[15px]">
                        Setuju & Lanjutkan
                    </button>
                </form>
            </div>

        </div>
    </main>

    <!-- Footer Optional (Jarak bawah) -->
    <div class="h-8 md:h-12"></div>

</body>
</html>