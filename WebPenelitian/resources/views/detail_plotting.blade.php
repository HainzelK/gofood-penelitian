<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skenario Kebijakan - {{ $plotting }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f2f8f2] md:h-screen flex flex-col md:overflow-hidden">

        <!-- Header -->
    <header class="bg-white py-3 px-4 md:px-6 shadow-sm border-b border-gray-100 sticky top-0 z-50 flex-shrink-0">
        <div class="max-w-7xl mx-auto flex justify-between items-center w-full">
            <div class="w-12 md:w-24">
                <a href="javascript:history.back()" class="inline-flex items-center justify-center w-10 h-10 bg-[#ffcc00] rounded-xl shadow-sm hover:bg-[#e6b800] transition-transform active:scale-95 text-black">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <span class="text-[#00880d] font-bold text-lg md:text-xl tracking-tight text-center flex-1 md:flex-none">go-food.site</span>
            <div class="min-w-[100px] md:min-w-[130px]"></div>
        </div>
    </header>

    <!-- MAIN CONTAINER -->
    <main class="flex-grow flex flex-col relative">

        <!-- 1. BACKGROUND DESKTOP ONLY -->
        <div class="hidden md:block absolute inset-0 z-0">
            @php $fileBase = strtolower($plotting); @endphp
            <img src="{{ asset('storage/' . $fileBase . '-desktop.png') }}" 
                 class="w-full h-full object-cover" alt="Background Desktop">
            <div class="absolute inset-0 bg-black/5"></div>
        </div>

        <!-- 2. LAYOUT WRAPPER -->
        <div class="relative z-10 w-full md:h-full flex flex-col md:flex-row items-center md:items-stretch">
            
            <!-- PANEL KIRI (Lebar diperkecil agar 'Fit' di samping) -->
            <div class="w-full md:w-[320px] lg:w-[350px] md:m-6 bg-white md:bg-white/95 md:backdrop-blur-md rounded-[1.5rem] md:rounded-[2.5rem] shadow-xl md:shadow-2xl p-4 md:p-6 border border-gray-100 flex flex-col justify-between md:max-h-[calc(100vh-120px)] overflow-y-auto">
                
                <div>
                    <!-- Badge Info -->
                    <div class="flex items-start gap-3 mb-4">
                        <div class="bg-[#4a1d1d] text-white w-7 h-7 flex-shrink-0 flex items-center justify-center rounded-lg font-bold text-lg">2</div>
                        <div class="text-[14px] md:text-[14px] leading-tight text-gray-800 font-medium">
                            Anda baru sampai di kantor dan melihat berita di TV tentang kebijakan baru pemerintah.
                        </div>
                    </div>

                    <!-- Judul Program -->
                    <div class="mb-4">
                        <p class="text-[#b01e1e] font-bold text-[14px] leading-snug">
                            Pemerintah menjalankan program <br>
                            <span class="font-extrabold text-[16px] md:text-[18px] uppercase tracking-tight">"Masyarakat Sehat, Ekonomi Kuat"</span>
                        </p>
                        <p class="text-gray-600 font-medium text-[11px] md:text-[12px] mt-1 italic">Diberlakukan dua kebijakan ekstrem serentak:</p>
                    </div>

                    <!-- GAMBAR TV KHUSUS MOBILE (Hanya di HP) -->
                    <div class="md:hidden w-full mb-6 rounded-xl overflow-hidden shadow-md border border-gray-200">
                        <img src="{{ asset('storage/' . strtolower($plotting) . '.jpeg') }}" class="w-full object-cover" alt="TV News Mobile">
                    </div>

                    <!-- KARTU KEBIJAKAN (Padat) -->
                    <div class="space-y-3">
                        <!-- 1. PAJAK -->
                        <div class="border-2 border-blue-900 rounded-2xl p-3 bg-white shadow-sm">
                            <h3 class="bg-[#1e40af] text-white text-center font-bold py-1 rounded-lg text-[12px] md:text-[12px] mb-2 uppercase">
                                1. PAJAK {{ $data['pajak'] }}
                            </h3>
                            <div class="flex gap-3 items-center mb-2">
                                <img src="{{ asset('storage/' . $data['icon_pajak']) }}" class="w-10 h-10 md:w-12 md:h-12 object-contain">
                                <p class="text-[12px] leading-tight text-gray-900 font-semibold">
                                    Pajak <span class="text-blue-700 uppercase">{{ $data['pajak'] }}</span> untuk makanan dengan kadar gula, garam, dan lemak tinggi.
                                </p>
                            </div>
                            <div class="text-[12px] text-gray-500 bg-gray-50 p-2 rounded-lg italic leading-tight">
                                {{ $data['pajak_desc'] }}
                            </div>
                        </div>

                        <!-- 2. INSENTIF -->
                        <div class="border-2 border-green-800 rounded-2xl p-3 bg-white shadow-sm">
                            <h3 class="bg-[#166534] text-white text-center font-bold py-1 rounded-lg text-[12px] md:text-[12px] mb-2 uppercase">
                                2. INSENTIF {{ $data['insentif'] }}
                            </h3>
                            <div class="flex gap-3 items-center mb-2">
                                <img src="{{ asset('storage/' . $data['icon_insentif']) }}" class="w-10 h-10 md:w-12 md:h-12 object-contain">
                                <p class="text-[12px] leading-tight text-gray-900 font-semibold">
                                    Potongan harga <span class="text-green-700 uppercase">{{ $data['insentif'] }}</span> diberikan pada menu makanan sehat.
                                </p>
                            </div>
                            <div class="text-[12px] text-gray-500 bg-gray-50 p-2 rounded-lg italic leading-tight">
                                {{ $data['insentif_desc'] }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Selanjutnya (Mobile: Di dalam panel) -->
                <div class="mt-6 md:hidden">
                    <a href="{{ route('instruksi.3') }}" 
                       class="block w-full text-center py-3.5 bg-[#00880d] text-white font-bold rounded-xl text-lg shadow-xl active:scale-95">
                        Selanjutnya
                    </a>
                </div>
            </div>

            <!-- Tombol Selanjutnya (Desktop: Pojok Kanan Bawah Layar) -->
            <div class="hidden md:block absolute bottom-8 right-8">
                <a href="{{ route('instruksi.3') }}" 
                   class="px-14 py-4 bg-[#00880d] text-white font-bold rounded-2xl hover:bg-[#00700a] transition-all text-xl shadow-2xl inline-block transform hover:scale-105 active:scale-95">
                    Selanjutnya
                </a>
            </div>

        </div>
    </main>

</body>
</html>