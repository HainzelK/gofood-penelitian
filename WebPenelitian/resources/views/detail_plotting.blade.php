<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skenario</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col overflow-hidden">

    <header class="bg-white py-3 shadow-sm border-b border-gray-100 flex justify-center sticky top-0 z-50">
        <span class="text-[#00880d] font-bold text-xl tracking-tight">go-food.site</span>
    </header>

    <main class="relative flex-grow flex items-center justify-center overflow-hidden">
        
        <!-- Background Dinamis -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('storage/' . $data['bg']) }}" class="w-full h-full object-cover">
        </div>

        <!-- Sidebar Panel Dinamis -->
        <div class="absolute left-4 md:left-10 top-10 bottom-10 w-[90%] md:w-[320px] bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl p-6 overflow-y-auto z-10 border border-gray-200">
            <div class="flex items-center gap-3 mb-4">
                <div class="bg-[#4a1d1d] text-white w-8 h-8 flex items-center justify-center rounded font-bold text-xl">2</div>
                <p class="text-[11px] font-semibold leading-tight text-gray-700">Anda baru sampai di kantor dan melihat berita di TV tentang kebijakan baru pemerintah.</p>
            </div>

            <h2 class="text-[#b01e1e] font-extrabold text-lg leading-tight mb-4 uppercase">
                Pemerintah menjalankan program "Masyarakat Sehat, Ekonomi Kuat"
            </h2>

            <div class="space-y-4">
                <!-- Kebijakan Pajak -->
                <div class="border border-blue-800 rounded-lg p-3 bg-white">
                    <h3 class="bg-[#1e40af] text-white text-center font-bold py-1 rounded text-sm mb-2 uppercase">1. PAJAK {{ $data['pajak'] }}</h3>
                    <div class="flex gap-2 items-start">
                        <img src="{{ asset('storage/junkfood_icon.png') }}" class="w-12 h-12 object-contain">
                        <p class="text-[10px] leading-tight text-gray-800">Pajak makanan kadar gula, garam, dan lemak tinggi berlaku <b class="text-blue-700">{{ $data['pajak'] }}</b>.</p>
                    </div>
                    <p class="text-[9px] mt-2 text-gray-500"><b>TUJUAN:</b> {{ $data['pajak_desc'] }}</p>
                </div>

                <!-- Kebijakan Insentif -->
                <div class="border border-green-800 rounded-lg p-3 bg-white">
                    <h3 class="bg-[#166534] text-white text-center font-bold py-1 rounded text-sm mb-2 uppercase">2. INSENTIF {{ $data['insentif'] }}</h3>
                    <div class="flex gap-2 items-start">
                        <img src="{{ asset('storage/healthy_icon.png') }}" class="w-12 h-12 object-contain">
                        <p class="text-[10px] leading-tight text-gray-800">Insentif (potongan harga) untuk menu sehat diberikan <b class="text-green-700">{{ $data['insentif'] }}</b>.</p>
                    </div>
                    <p class="text-[9px] mt-2 text-gray-500"><b>TUJUAN:</b> {{ $data['insentif_desc'] }}</p>
                </div>
            </div>
        </div>

        <div class="absolute bottom-8 right-8 z-20">
            <a href="{{ route('instruksi.3') }}" class="px-12 py-3.5 bg-[#00880d] text-white font-bold rounded-xl hover:bg-[#00700a] transition-all text-lg shadow-xl inline-block">
                Selanjutnya
            </a>
        </div>
    </main>

</body>
</html>