<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih - Go-Food</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Menggunakan font yang mirip dengan tulisan cat di gambar -->
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Plus+Jakarta+Sans:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .paint-text { font-family: 'Permanent Marker', cursive; }
        
        /* Efek latar belakang seng/logam bergelombang */
        .corrugated-bg {
            /* Menggunakan fixed agar background tidak ikut tergulung saat scroll */
            background: linear-gradient(90deg, 
                #9ca3af 0%, #d1d5db 25%, #9ca3af 50%, #d1d5db 75%, #9ca3af 100%);
            background-size: 20px 100%; /* Perkecil angka 20px jika ingin garis lebih rapat */
            background-attachment: fixed;
        }

        /* Tekstur kayu sederhana */
        .wood-board {
            background-color: #8b5a2b;
            background-image: repeating-linear-gradient(90deg, transparent, transparent 50px, rgba(0,0,0,0.1) 50px, rgba(0,0,0,0.1) 100px);
            box-shadow: 10px 10px 20px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body class="corrugated-bg min-h-screen flex flex-col items-center justify-center relative overflow-hidden">

    <!-- Efek Aspal/Jalan di bagian bawah -->
    <div class="absolute bottom-0 w-full h-1/4 bg-[#374151] z-0"></div>

    <!-- Area Konten Utama -->
    <div class="z-10 flex flex-col items-center gap-10">
        
        <!-- Papan Kayu -->
        <div class="flex flex-col md:flex-row gap-4 px-6">
            <!-- Papan 1: THANK -->
            <div class="wood-board p-8 md:p-12 rotate-[-1deg] border-b-4 border-r-4 border-black/20 flex items-center justify-center">
                <h1 class="paint-text text-[#fafafa] text-6xl md:text-9xl tracking-tighter uppercase">
                    Thank
                </h1>
            </div>
            
            <!-- Papan 2: YOU. -->
            <div class="wood-board p-8 md:p-12 rotate-[1deg] border-b-4 border-r-4 border-black/20 flex items-center justify-center">
                <h1 class="paint-text text-[#fafafa] text-6xl md:text-9xl tracking-tighter uppercase">
                    You ‹𝟹
                </h1>
            </div>
        </div>

        <!-- Pesan Tambahan & Navigasi -->
        <div class="text-center mt-6">
            <button onclick="window.location.href='/consent'" class="group flex items-center gap-3 bg-[#00880d] hover:bg-[#00700a] text-white font-bold py-4 px-10 rounded-2xl transition-all shadow-xl active:scale-95">
                <i class="fas fa-home group-hover:-translate-x-1 transition-transform"></i>
                Kembali ke Beranda
            </button>
        </div>

    </div>

    <script>
        // Saat sampai di halaman ini, pastikan data keranjang dihapus
        // Tapi kita tidak menghapus 'gofood_already_topped_up' di sini jika Anda ingin batasan tetap berlaku
        localStorage.removeItem('gofood_cart');
        
        // Opsional: Hapus flag top up jika ingin simulasi bisa diulang di sesi berikutnya
        localStorage.removeItem('gofood_already_topped_up');
    </script>

</body>
</html>