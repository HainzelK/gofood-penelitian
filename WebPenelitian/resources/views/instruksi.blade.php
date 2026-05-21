<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instruksi Pengerjaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f2f8f2] min-h-screen flex flex-col">

    <header class="bg-white py-4 shadow-sm border-b border-gray-100 flex justify-center sticky top-0 z-10">
        <span class="text-[#00880d] font-bold text-xl">go-food.site</span>
    </header>

    <main class="flex-grow flex items-center justify-center p-6">
        <div class="bg-white w-full max-w-xl rounded-[2.5rem] shadow-xl p-10 md:p-14">
            
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-8">
                Instruksi Pengerjaan
            </h1>

            <ul class="space-y-4 text-gray-700 font-semibold leading-relaxed text-[18px] md:text-[18px]">
                <li class="flex gap-2">
                    <span>•</span>
                    <p>Terima kasih telah mengisi data diri anda.</p>
                </li>
                <li class="flex gap-2">
                    <span>•</span>
                    <p>Sebelum melanjutkan simulasi, sebagai pengingat, Anda nantinya akan berperan sebagai user pengguna akun Go-Food. Simulasi ini nantinya hanya menginstruksikan Anda untuk memilih dan check out/order makan via website ini.</p>
                </li>
            </ul>

            <div class="mt-12 flex justify-center">
                <!-- Tombol ini memicu route pengecekan domisili -->
                <a href="{{ route('mulai.simulasi') }}" 
                   class="w-full md:w-auto text-center px-12 py-3.5 bg-[#00880d] text-white font-bold rounded-xl hover:bg-[#00700a] transition-all text-lg shadow-md">
                    Mulai
                </a>
            </div>

        </div>
    </main>

</body>
</html>