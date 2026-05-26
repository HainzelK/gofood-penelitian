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
        
        .appearance-none { appearance: none; -webkit-appearance: none; }

        /* Tinggi Standar Kotak */
        .field-container { height: 62px; position: relative; }

        /* --- LOGIKA FLOATING LABEL --- */
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    
    .appearance-none { appearance: none; -webkit-appearance: none; }
    .field-container { height: 62px; position: relative; }

    /* --- LOGIKA FLOATING LABEL --- */
    .floating-label {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background-color: white;
        padding: 0 0.25rem;
        color: #6b7280;
        transition: all 0.2s ease-in-out;
        pointer-events: none;
        z-index: 20;
    }

    /* --- LOGIKA WARNA & POSISI (INPUT & SELECT) --- */

    /* 1. Saat Fokus (Diklik) */
    .input-field:focus ~ .floating-label,
    .select-field:focus ~ .floating-label,
    /* 2. Saat Terisi (Valid atau Ada Teks) */
    .input-field:not(:placeholder-shown) ~ .floating-label,
    .select-field:valid ~ .floating-label {
        top: 0;
        font-size: 0.75rem;
        color: #00880d;
        font-weight: 700;
    }

    /* 3. Border Hijau Saat Fokus atau Terisi */
    .input-field:focus,
    .select-field:focus,
    .input-field:not(:placeholder-shown),
    .select-field:valid {
        border-color: #00880d;
        border-width: 2px;
    }

    label, .floating-label {
        transition: all 0.2s ease-in-out;
    }

        /* Khusus Select (karena tidak punya placeholder-shown) */
        .select-field:valid ~ .floating-label {
            top: 0;
            font-size: 0.75rem;
            color: #00880d;
            font-weight: 700;
        }
        .select-field:valid {
            border-color: #00880d;
            border-width: 2px;
        }
    </style>
</head>
<body class="bg-[#f2f8f2] min-h-screen flex flex-col">

    <header class="bg-white py-4 shadow-sm border-b border-gray-100 sticky top-0 z-50 flex justify-center">
        <span class="text-[#00880d] font-bold text-xl tracking-tight">go-food.site</span>
    </header>

    <main class="flex-grow flex items-center justify-center p-4 md:p-8">
        <div class="bg-white w-full max-w-4xl rounded-[2.5rem] shadow-xl p-8 md:p-12">
            
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-10">Informasi Diri</h1>

            <form action="{{ route('simpan.informasi') }}" method="POST" id="formDiri" class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-10">
                @csrf

                <!-- Nama Lengkap -->
                <div class="field-container">
                    <input type="text" name="nama" id="nama" placeholder=" " required
                        class="input-field w-full h-full border-2 border-gray-300 rounded-2xl px-4 outline-none transition-all focus:ring-0 font-medium text-gray-800">
                    <label class="floating-label">Nama Lengkap</label>
                </div>

                <!-- Jenis Kelamin -->
                <div class="field-container">
                    <select name="gender" id="gender" required
                        class="select-field w-full h-full border-2 border-gray-300 rounded-2xl px-4 outline-none transition-all focus:ring-0 font-medium text-gray-800 appearance-none bg-transparent relative z-10 cursor-pointer">
                        <option value="" disabled selected hidden></option>
                        <option value="Laki-laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <label class="floating-label">Jenis Kelamin</label>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                </div>

                <!-- Usia -->
                <div class="field-container">
                    <input type="number" name="usia" id="usia" placeholder=" " required
                        class="input-field w-full h-full border-2 border-gray-300 rounded-2xl pl-4 pr-16 outline-none transition-all focus:ring-0 font-medium text-gray-800">
                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none">tahun</span>
                    <label class="floating-label">Usia</label>
                </div>

                <!-- Pendidikan Terakhir -->
                <div class="field-container">
                    <select name="pendidikan" id="pendidikan" required
                        class="select-field w-full h-full border-2 border-gray-300 rounded-2xl px-4 outline-none transition-all focus:ring-0 font-medium text-gray-800 appearance-none bg-transparent relative z-10 cursor-pointer">
                        <option value="" disabled selected hidden></option>
                        <option value="SMA/Sederajat">SMA/Sederajat</option>
                        <option value="Diploma(D3)">Diploma (D3)</option>
                        <option value="Sarjana(S1)">Sarjana (S1)</option>
                        <option value="Magister(S2)">Magister (S2)</option>
                        <option value="Doktor(S3)">Doktor (S3)</option>
                    </select>
                    <label class="floating-label">Pendidikan Terakhir</label>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                </div>

                <!-- Daerah Domisili -->
                <div class="field-container">
                    <select name="domisili" id="domisili" required
                        class="select-field w-full h-full border-2 border-gray-300 rounded-2xl px-4 outline-none transition-all focus:ring-0 font-medium text-gray-800 appearance-none bg-transparent relative z-10 cursor-pointer">
                        <option value="" disabled selected hidden></option>
                        <option value="Makassar">Kota Makassar</option>
                        <option value="Toraja">Toraja</option>
                    </select>
                    <label class="floating-label">Daerah Domisili</label>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                </div>

                <!-- Kecamatan -->
                <div class="field-container">
                    <input type="text" name="kecamatan" id="kecamatan" placeholder=" " required
                        class="input-field w-full h-full border-2 border-gray-300 rounded-2xl px-4 outline-none transition-all focus:ring-0 font-medium text-gray-800">
                    <label class="floating-label">Kecamatan</label>
                </div>

                <!-- Pekerjaan -->
                <div class="field-container">
                    <input type="text" name="pekerjaan" id="pekerjaan" placeholder=" " required
                        class="input-field w-full h-full border-2 border-gray-300 rounded-2xl px-4 outline-none transition-all focus:ring-0 font-medium text-gray-800">
                    <label class="floating-label">Pekerjaan</label>
                </div>

                <!-- No HP (Fix: Klik di mana saja di box) -->
                <div class="field-container group">
                    <input type="tel" name="no_hp" id="no_hp" placeholder=" " required
                        oninput="formatPhoneNumber(this)"
                        class="input-field w-full h-full border-2 border-gray-300 rounded-2xl pl-4 pr-4 outline-none transition-all focus:ring-0 font-medium text-gray-800 tracking-widest">
                    <label class="floating-label">No. Handphone</label>
                    <p id="phone-error" class="text-[10px] text-red-500 mt-1 hidden absolute -bottom-5 left-2 italic">Minimal 9 angka.</p>
                </div>

                <!-- Footer -->
                <div class="md:col-span-2 mt-6 flex flex-col md:flex-row items-center gap-6">
                    <p class="text-[14px] text-red-600 italic flex-1 max-w-none">
                        *Jangan lupa isi data diri dan nomor HP dengan tepat! Dapatkan kesempatan memenangkan saldo OVO/Pulsa sebesar Rp 500.000 untuk 10 orang pemenang beruntung. Pemenang akan diundi secara acak pada akhir periode pengumpulan data.
                    </p>
                    <button type="submit" class="w-full md:w-auto px-12 py-3.5 bg-[#00880d] text-white font-bold rounded-xl hover:bg-[#00700a] transition-all text-lg shadow-md flex-shrink-0">
                        Selanjutnya
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        function formatPhoneNumber(input) {
            let value = input.value.replace(/\D/g, '');
            if (value.length > 13) value = value.slice(0, 13);
            let formattedValue = "";
            for (let i = 0; i < value.length; i++) {
                if (i === 3 || i === 7 || i === 11) formattedValue += " ";
                formattedValue += value[i];
            }
            input.value = formattedValue;
            const errorText = document.getElementById('phone-error');
            errorText.classList.toggle('hidden', value.length === 0 || value.length >= 9);
        }
    </script>
</body>
</html>