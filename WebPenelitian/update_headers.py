import os
import re

files_to_update = [
    'resources/views/consent.blade.php',
    'resources/views/informasi_diri.blade.php',
    'resources/views/informasi_umum_makassar.blade.php',
    'resources/views/informasi_umum_toraja.blade.php',
    'resources/views/instruksi.blade.php',
    'resources/views/detail_plotting.blade.php',
    'resources/views/instruksi_3.blade.php',
    'resources/views/pilihan_menu.blade.php'
]

header_replacement = '''    <!-- Header -->
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
    </header>'''

header_pattern = re.compile(r'<!-- Header.*?<header.*?</header>', re.DOTALL | re.IGNORECASE)
header_pattern2 = re.compile(r'<header.*?</header>', re.DOTALL | re.IGNORECASE)

fa_link = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">'

for file_path in files_to_update:
    if not os.path.exists(file_path):
        print(f'File not found: {file_path}')
        continue
    with open(file_path, 'r', encoding='utf-8') as f:
        content = f.read()

    # Add font-awesome if not exists
    if fa_link not in content:
        content = content.replace('<script src="https://cdn.tailwindcss.com"></script>', '<script src="https://cdn.tailwindcss.com"></script>\n    ' + fa_link)

    # Replace Header
    if header_pattern.search(content):
        content = header_pattern.sub(header_replacement, content)
    else:
        content = header_pattern2.sub(header_replacement, content)
    
    with open(file_path, 'w', encoding='utf-8') as f:
        f.write(content)
    print(f'Updated {file_path}')
