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
<body class="bg-gray-100 h-screen flex flex-col overflow-hidden">

    <header class="bg-white py-2 shadow-sm border-b border-gray-100 flex justify-center flex-shrink-0">
        <span class="text-[#00880d] font-bold text-lg tracking-tight">go-food.site</span>
    </header>

    <main class="relative flex-grow flex items-center justify-center p-2 overflow-hidden">
        <!-- Background -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('storage/' . $data['bg']) }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/5"></div>
        </div>

        <!-- Sidebar Panel Dinamis (Ukuran dipadatkan agar tidak scroll) -->
        <div class="relative z-10 w-full max-w-[340px] md:max-w-[380px] bg-white/95 backdrop-blur-md rounded-[2rem] shadow-2xl p-4 md:p-6 border border-gray-100 flex flex-col max-h-[90vh]">
            
            <div class="flex items-start gap-3 mb-3">
                <div class="bg-[#4a1d1d] text-white w-7 h-7 flex-shrink-0 flex items-center justify-center rounded-lg font-bold text-base">2</div>
                <p class="text-[12px] md:text-[13px] font-medium leading-tight text-gray-800">
                    Melihat berita di TV tentang kebijakan baru pemerintah.
                </p>
            </div>

            <h2 class="text-[#b01e1e] font-extrabold text-[14px] md:text-[16px] leading-tight mb-3 uppercase text-center">
                PROGRAM "MASYARAKAT SEHAT, EKONOMI KUAT"
            </h2>

            <div class="space-y-3 flex-grow overflow-hidden">
                <!-- Kebijakan 1: PAJAK -->
                <div class="border-2 border-blue-900 rounded-xl p-3 bg-white shadow-sm">
                    <h3 class="bg-[#1e40af] text-white text-center font-bold py-1 rounded-lg text-[11px] mb-2 uppercase">
                        1. PAJAK {{ $data['pajak'] }}
                    </h3>
                    <div class="flex gap-3 items-center">
                        <img src="{{ asset('storage/' . $data['icon_pajak']) }}" class="w-10 h-10 object-contain">
                        <p class="text-[11px] leading-tight text-gray-900 font-medium">
                            Pajak junk food berlaku <span class="font-bold text-blue-700">{{ $data['pajak'] }}</span>.
                        </p>
                    </div>
                    <p class="text-[10px] mt-1 text-gray-600 bg-gray-50 p-1 rounded italic leading-tight">
                        <b>TUJUAN:</b> {{ $data['pajak_desc'] }}
                    </p>
                </div>

                <!-- Kebijakan 2: INSENTIF -->
                <div class="border-2 border-green-800 rounded-xl p-3 bg-white shadow-sm">
                    <h3 class="bg-[#166534] text-white text-center font-bold py-1 rounded-lg text-[11px] mb-2 uppercase">
                        2. INSENTIF {{ $data['insentif'] }}
                    </h3>
                    <div class="flex gap-3 items-center">
                        <img src="{{ asset('storage/' . $data['icon_insentif']) }}" class="w-10 h-10 object-contain">
                        <p class="text-[11px] leading-tight text-gray-900 font-medium">
                            Insentif menu sehat diberikan <span class="font-bold text-green-700">{{ $data['insentif'] }}</span>.
                        </p>
                    </div>
                    <p class="text-[10px] mt-1 text-gray-600 bg-gray-50 p-1 rounded italic leading-tight">
                        <b>TUJUAN:</b> {{ $data['insentif_desc'] }}
                    </p>
                </div>
            </div>

            <!-- Tombol dipindahkan ke dalam box agar hemat tempat di mobile -->
            <div class="mt-4">
                <a href="{{ route('instruksi.3') }}" 
                   class="block w-full text-center py-3 bg-[#00880d] text-white font-bold rounded-xl hover:bg-[#00700a] text-base shadow-lg transition-transform active:scale-95">
                    Selanjutnya
                </a>
            </div>
        </div>
    </main>
</body>
</html>