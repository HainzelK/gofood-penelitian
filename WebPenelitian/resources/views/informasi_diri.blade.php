<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Diri</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* Gaya khusus untuk dropdown agar ada panahnya */
        .custom-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7' /%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1.2rem;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #00880d !important;
            box-shadow: 0 0 0 1px #00880d;
        }
    </style>
</head>
<body class="bg-[#f2f8f2] min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-white py-4 shadow-sm border-b border-gray-100 sticky top-0 z-10">
        <div class="container mx-auto px-4 flex justify-center">
            <span class="text-[#00880d] font-bold text-xl tracking-tight">go-food.site</span>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center p-4 md:p-8">
        <div class="bg-white w-full max-w-3xl rounded-[2.5rem] shadow-xl p-8 md:p-12">
            
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-8">
                Informasi Diri
            </h1>

            <form action="#" method="POST" id="formDiri">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    
                    <!-- Nama Lengkap -->
                    <input type="text" name="nama" placeholder="Nama Lengkap" required
                        class="w-full px-5 py-3.5 border border-gray-200 rounded-xl bg-gray-50/30">

                    <!-- Jenis Kelamin -->
                    <select name="gender" required class="custom-select w-full px-5 py-3.5 border border-gray-200 rounded-xl bg-gray-50/30 text-gray-500">
                        <option value="" disabled selected>Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>

                    <!-- Usia -->
                    <input type="number" name="usia" placeholder="Usia" required
                        class="w-full px-5 py-3.5 border border-gray-200 rounded-xl bg-gray-50/30">

                    <!-- Pendidikan Terakhir -->
                    <select name="pendidikan" required class="custom-select w-full px-5 py-3.5 border border-gray-200 rounded-xl bg-gray-50/30 text-gray-500">
                        <option value="" disabled selected>Pendidikan Terakhir</option>
                        <option value="SMA">SMA/Sederajat</option>
                        <option value="D3">Diploma (D3)</option>
                        <option value="S1">Sarjana (S1)</option>
                        <option value="S2">Magister (S2)</option>
                    </select>

                    <!-- Daerah Domisili -->
                    <select name="domisili" required class="custom-select w-full px-5 py-3.5 border border-gray-200 rounded-xl bg-gray-50/30 text-gray-500">
                        <option value="" disabled selected>Daerah Domisili</option>
                        <option value="Makassar">Makassar</option>
                        <option value="Toraja">Toraja</option>
                    </select>

                    <!-- Kecamatan -->
                    <input type="text" name="kecamatan" placeholder="Kecamatan" required
                        class="w-full px-5 py-3.5 border border-gray-200 rounded-xl bg-gray-50/30">

                    <!-- Pekerjaan -->
                    <input type="text" name="pekerjaan" placeholder="Pekerjaan" required
                        class="w-full px-5 py-3.5 border border-gray-200 rounded-xl bg-gray-50/30">

                    <!-- No HP (Hanya Angka & Validasi Indo) -->
                    <div class="relative">
                        <input type="tel" id="no_hp" name="no_hp" placeholder="No. HP (Contoh: 0812...)" required
                            oninput="validatePhone(this)"
                            class="w-full px-5 py-3.5 border border-gray-200 rounded-xl bg-gray-50/30">
                        <p id="phone-error" class="text-[10px] text-red-500 mt-1 hidden italic">Masukkan nomor HP yang valid (minimal 10 angka)</p>
                    </div>
                </div>

                <!-- Footer Form -->
                <div class="mt-10 flex flex-col md:flex-row items-center justify-between gap-6">
                    <p class="text-[12px] md:text-[12px] text-red-600 leading-relaxed max-w-sm italic">
                        **Jangan lupa isi data diri dan nomor HP dengan tepat! Dapatkan kesempatan memenangkan saldo OVO/Pulsa sebesar Rp 500.000 untuk 10 orang pemenang beruntung. Pemenang akan diundi secara acak pada akhir periode pengumpulan data.
                    </p>

                    <button type="submit" class="w-full md:w-auto px-12 py-4 bg-[#00880d] text-white font-bold rounded-2xl hover:bg-[#00700a] shadow-lg shadow-green-100 transition-all text-center">
                        Selanjutnya
                    </button>
                </div>
            </form>

        </div>
    </main>

    <script>
        function validatePhone(input) {
            // hapus karakter selain angka
            input.value = input.value.replace(/[^0-9]/g, '');

            // Validasi panjang dan awal nomor (biasanya 08 atau 62)
            const errorText = document.getElementById('phone-error');
            if (input.value.length > 0 && input.value.length < 10) {
                errorText.classList.remove('hidden');
            } else {
                errorText.classList.add('hidden');
            }

            // Batasi maksimal 15 angka
            if (input.value.length > 15) {
                input.value = input.value.slice(0, 15);
            }
        }
    </script>
</body>
</html>