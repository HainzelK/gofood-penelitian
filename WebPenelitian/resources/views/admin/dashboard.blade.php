<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peneliti - Go-Food Site</title>
    
    <!-- SCRIPT INI WAJIB ADA AGAR TAMPILAN BAGUS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
</head>
<body class="bg-gray-50 min-h-screen">

    <!-- Navbar Atas -->
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 md:px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-[#00880d] rounded-lg flex items-center justify-center">
                    <i class="fas fa-chart-pie text-white text-xs"></i>
                </div>
                <span class="text-xl font-extrabold text-gray-900 tracking-tight">Dashboard<span class="text-[#00880d]">Admin</span></span>
            </div>
            
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-sm font-bold text-red-500 hover:bg-red-50 px-4 py-2 rounded-xl transition-all">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </button>
            </form>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 md:px-6 py-10">
        
        <!-- Header & Action -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Hasil Jawaban Responden</h1>
                <p class="text-gray-500 mt-1 font-medium">Pantau data riset Anda secara real-time.</p>
            </div>
            
            <a href="{{ route('admin.download') }}" class="inline-flex items-center justify-center gap-3 bg-[#00880d] hover:bg-[#00700a] text-white font-bold py-4 px-8 rounded-2xl shadow-lg shadow-green-100 transition-all active:scale-95">
                <i class="fas fa-file-excel text-xl"></i>
                Download Data (.csv)
            </a>
        </div>

        <!-- Tabel Preview -->
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50/50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Waktu</th>
                            <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Responden</th>
                            <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Domisili</th>
                            <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Plotting</th>
                            <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Total Bayar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($jawabans as $j)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-5">
                                <span class="text-xs font-bold text-gray-400">{{ $j->Tanggal }}</span>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-xs font-bold">
                                        {{ substr($j->Nama, 0, 1) }}
                                    </div>
                                    <span class="font-bold text-gray-800">{{ $j->Nama }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <p class="text-sm text-gray-600 font-medium italic">
                                    {{ $j->DaerahDomisili }}
                                </p>
                            </td>
                            <td class="px-6 py-5">
                                <p class="text-sm text-gray-600 font-medium italic">
                                    {{ $j->Plotting}}
                                </p>
                            </td>
                            <td class="px-6 py-5 text-right">
                                <span class="inline-block bg-green-50 text-[#00880d] px-3 py-1 rounded-lg font-extrabold text-sm">
                                    Rp{{ number_format($j->Total, 0, ',', '.') }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-20 text-center">
                                <i class="fas fa-folder-open text-gray-200 text-5xl mb-4 block"></i>
                                <span class="text-gray-400 font-medium italic">Belum ada data responden masuk.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer -->
        <p class="text-center mt-10 text-gray-300 text-[10px] font-bold uppercase tracking-[0.3em]">
            go-food.site &bull; Peneliti Admin Panel &bull; 2026
        </p>

    </main>

</body>
</html>