<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Umum - Toraja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f2f8f2] min-h-screen flex flex-col overflow-x-hidden">

    <!-- Header -->
    <header class="bg-white py-4 shadow-sm border-b border-gray-100 sticky top-0 z-50 flex justify-center">
        <span class="text-[#00880d] font-bold text-xl tracking-tight">go-food.site</span>
    </header>

    <!-- Hero Section Container -->
    <main class="relative flex-grow flex items-center justify-center md:justify-end overflow-hidden">
        
        <!-- Background Image -->
        <!-- Ganti URL di bawah dengan path gambar asli Anda, misal: asset('images/toraja-bg.jpg') -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('storage/toraja.PNG') }}" 
                 alt="Background" 
                 class="w-full h-full object-cover object-center brightness-90">
            <!-- Overlay gelap tipis agar teks lebih terbaca jika gambar terlalu terang -->
            <div class="absolute inset-0 bg-black/10"></div>
        </div>

        <!-- Floating Info Card -->
        <div class="relative z-10 w-[90%] md:w-[450px] bg-white/95 backdrop-blur-sm p-8 md:p-12 rounded-[2.5rem] shadow-2xl mx-4 md:mr-24 lg:mr-40 transition-all">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">
                Informasi Umum
            </h1>
            
            <p class="text-gray-700 leading-relaxed text-sm md:text-base font-medium">
                Anda adalah pegawai di pusat Kota Rantepao atau Makale. Karena jadwal kerja yang padat, Anda mengandalkan Go-Food minimal 6x sebulan untuk makan siang.
            </p>
        </div>

        <!-- Floating Button Selanjutnya -->
        <div class="absolute bottom-10 right-10 z-20">
            <a href="{{ route('pilihan.menu') }}" class="w-full md:w-auto px-12 py-3.5 bg-[#00880d] text-white font-bold rounded-xl hover:bg-[#00700a] transition-all text-lg shadow-md">
                Selanjutnya
            </a>
        </div>
        
    </main>

</body>
</html>