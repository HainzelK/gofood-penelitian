<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buka Aplikasi Go-Food</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col overflow-hidden">

        <!-- Header -->
    <header class="bg-white py-3 px-4 md:px-6 shadow-sm border-b border-gray-100 sticky top-0 z-50 flex-shrink-0">
        <div class="max-w-7xl mx-auto flex justify-between items-center w-full">
            <div class="w-12 md:w-24">
                <a href="javascript:history.back()" class="inline-flex items-center justify-center w-10 h-10 bg-[#ffcc00] rounded-xl shadow-sm hover:bg-[#e6b800] transition-transform active:scale-95 text-black">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <div class="flex items-center justify-center gap-2 flex-1 md:flex-none">
                <span class="text-[#00880d] font-bold text-lg md:text-xl tracking-tight">go-food.site</span>
            </div>
            <div class="min-w-[100px] md:min-w-[130px]"></div>
        </div>
    </header>

    <main class="relative flex-grow flex items-center justify-center overflow-hidden">
        
        <!-- Background Image (Gambar Orang Pegang HP) -->
        <div class="absolute inset-0 z-0">
             @php
                // Ambil data dari session
                $domisili = strtolower(session('data_pendaftar.domisili', ''));
                $gender = session('data_pendaftar.gender');

                // Logika Penentuan Tema (Makassar atau Toraja)
                if ($domisili == 'makassar') {
                    $theme = 'makassar';
                } elseif ($domisili == 'toraja') {
                    $theme = 'toraja';
                } else {
                    // Jika bukan keduanya (Lainnya)
                    $theme = ($gender == 'Perempuan') ? 'perempuan' : 'laki';
                }
            @endphp

            @if($theme == 'makassar')
                <!-- Gambar Desktop -->
                <img src="{{ asset('storage/instruksi3-desktop-makassar.jpeg') }}" 
                     alt="Desktop" 
                     class="hidden md:block w-full h-full object-cover object-top">
                
                <!-- Gambar HP -->
                <img src="{{ asset('storage/phone_instruksi3_makassar.jpeg') }}" 
                     alt="Mobile" 
                     class="block md:hidden w-full h-full object-cover object-top">
            @elseif($theme == 'toraja')
                <!-- Gambar Desktop -->
                <img src="{{ asset('storage/instruksi3-desktop-toraja.PNG') }}" 
                     alt="Desktop" 
                     class="hidden md:block w-full h-full object-cover object-top">
                
                <!-- Gambar HP -->
                <img src="{{ asset('storage/phone_instruksi3_toraja.png') }}" 
                     alt="Mobile" 
                     class="block md:hidden w-full h-full object-cover object-top">
            @elseif($theme == 'perempuan')
            <!-- Gambar Desktop -->
                <img src="{{ asset('storage/desktop_instruksi3_lainnya.jpeg') }}" 
                     alt="Desktop" 
                     class="hidden md:block w-full h-full object-cover object-top">
                
                <!-- Gambar HP -->
                <img src="{{ asset('storage/phone_instruksi3_lainnya.jpeg') }}" 
                     alt="Mobile" 
                     class="block md:hidden w-full h-full object-cover object-top">
            @elseif($theme == 'laki')
                <!-- Gambar Desktop -->
                <img src="{{ asset('storage/instruksi3-desktop-makassar.jpeg') }}" 
                     alt="Desktop" 
                     class="hidden md:block w-full h-full object-cover object-top">
                
                <!-- Gambar HP -->
                <img src="{{ asset('storage/phone_instruksi3_makassar.jpeg') }}" 
                     alt="Mobile" 
                     class="block md:hidden w-full h-full object-cover object-top">
            @endif
            
            <div class="absolute inset-0 bg-black/10"></div>
        </div>

        <!-- Sidebar Panel -->
        <div class="absolute left-4 {{ $theme == 'makassar' || $theme == 'laki' ? 'md:left-auto md:right-10' : 'md:left-10' }} top-10 md:top-20 w-[90%] md:w-[320px] bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl p-6 z-10 border border-gray-100">
            
            <div class="flex items-start gap-4">
                <!-- Badge Angka 3 -->
                <div class="bg-[#002d57] text-white w-9 h-9 flex-shrink-0 flex items-center justify-center rounded-lg font-bold text-xl">3</div>
                
                <!-- Teks Instruksi -->
                <p class="text-[14px] md:text-[15px] font-medium leading-relaxed text-gray-800">
                    Karena merasa lapar dan teringat berita tadi, Anda membuka aplikasi <span class="text-[#00880d] font-bold">Go-Food</span> untuk melihat menu makan siang.
                </p>
            </div>
        </div>

        <!-- Tombol Selanjutnya (Kanan Bawah) -->
        <div class="fixed bottom-10 left-0 right-0 md:left-auto md:right-10 flex justify-center md:block z-20">
            <a href="{{ route('pilihan.menu') }}" 
               class="w-[85%] md:w-auto text-center px-12 py-4 bg-[#00880d] text-white font-bold rounded-2xl hover:bg-[#00700a] transition-all text-lg shadow-xl">
                Selanjutnya
            </a>
        </div>
        
    </main>

</body>
</html>