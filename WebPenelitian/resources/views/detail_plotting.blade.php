<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skenario Kebijakan - {{ $plotting }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col overflow-hidden">

    <!-- Header -->
    <header class="bg-white py-3 shadow-sm border-b border-gray-100 flex justify-center sticky top-0 z-50">
        <span class="text-[#00880d] font-bold text-xl tracking-tight">go-food.site</span>
    </header>

    <main class="relative flex-grow flex items-center justify-center overflow-hidden">
        
        <!-- Background Dinamis -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('storage/' . $data['bg']) }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/5"></div>
        </div>

        <!-- Sidebar Panel Dinamis -->
        <div class="absolute left-4 md:left-10 top-6 bottom-6 w-[90%] md:w-[350px] bg-white/95 backdrop-blur-md rounded-[2.5rem] shadow-2xl p-7 overflow-y-auto z-10 border border-gray-100">
            
            <!-- Step 2 Badge -->
            <div class="flex items-start gap-4 mb-6">
                <div class="bg-[#4a1d1d] text-white w-9 h-9 flex-shrink-0 flex items-center justify-center rounded-lg font-bold text-xl">2</div>
                <p class="text-[13px] font-medium leading-tight text-gray-800">
                    Anda baru sampai di kantor dan melihat berita di TV tentang kebijakan baru pemerintah.
                </p>
            </div>

            <!-- Judul Skenario -->
            <h2 class="text-[#b01e1e] font-extrabold text-lg leading-tight mb-6 uppercase">
                Pemerintah menjalankan program "Masyarakat Sehat, Ekonomi Kuat"
            </h2>

            <div class="space-y-5">
                <!-- Kebijakan 1: PAJAK -->
                <div class="border-2 border-blue-900 rounded-2xl p-4 bg-white shadow-sm">
                    <h3 class="bg-[#1e40af] text-white text-center font-bold py-1.5 rounded-lg text-sm mb-3 uppercase tracking-wide">
                        1. PAJAK {{ $data['pajak'] }}
                    </h3>
                    <div class="flex gap-4 items-center">
                        <!-- Ikon Pajak Dinamis -->
                        <img src="{{ asset('storage/' . $data['icon_pajak']) }}" class="w-14 h-14 object-contain">
                        <p class="text-[11px] leading-tight text-gray-900 font-medium">
                            Pajak makanan kadar gula, garam, dan lemak tinggi berlaku <span class="font-bold text-blue-700 uppercase">{{ $data['pajak'] }}</span>.
                        </p>
                    </div>
                    <p class="text-[10px] mt-3 text-gray-600 bg-gray-50 p-2 rounded-lg italic">
                        <b>TUJUAN:</b> {{ $data['pajak_desc'] }}
                    </p>
                </div>

                <!-- Kebijakan 2: INSENTIF -->
                <div class="border-2 border-green-800 rounded-2xl p-4 bg-white shadow-sm">
                    <h3 class="bg-[#166534] text-white text-center font-bold py-1.5 rounded-lg text-sm mb-3 uppercase tracking-wide">
                        2. INSENTIF {{ $data['insentif'] }}
                    </h3>
                    <div class="flex gap-4 items-center">
                        <!-- Ikon Insentif Dinamis -->
                        <img src="{{ asset('storage/' . $data['icon_insentif']) }}" class="w-14 h-14 object-contain">
                        <p class="text-[11px] leading-tight text-gray-900 font-medium">
                            Insentif (potongan harga) untuk menu sehat diberikan <span class="font-bold text-green-700 uppercase">{{ $data['insentif'] }}</span>.
                        </p>
                    </div>
                    <p class="text-[10px] mt-3 text-gray-600 bg-gray-50 p-2 rounded-lg italic">
                        <b>TUJUAN:</b> {{ $data['insentif_desc'] }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Tombol Selanjutnya -->
        <div class="absolute bottom-10 right-10 z-20">
            <a href="{{ route('instruksi.3') }}" 
               class="px-14 py-4 bg-[#00880d] text-white font-bold rounded-2xl hover:bg-[#00700a] transition-all text-xl shadow-2xl inline-block transform hover:scale-105 active:scale-95">
                Selanjutnya
            </a>
        </div>
    </main>

</body>
</html>