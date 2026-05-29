import os
import re

favicon_link = '<link rel="icon" type="image/svg+xml" href="{{ asset(\'favicon.svg\') }}">'

def inject_favicon(directory):
    for root, _, files in os.walk(directory):
        for file in files:
            if file.endswith('.blade.php'):
                file_path = os.path.join(root, file)
                try:
                    with open(file_path, 'r', encoding='utf-8') as f:
                        content = f.read()

                    # If </head> exists and favicon is not already there
                    if '</head>' in content and 'favicon.svg' not in content:
                        # Replace </head> with the favicon link + </head>
                        new_content = content.replace('</head>', f'    {favicon_link}\n</head>')
                        
                        with open(file_path, 'w', encoding='utf-8') as f:
                            f.write(new_content)
                        print(f"Injected into {file_path}")
                except Exception as e:
                    print(f"Failed to process {file_path}: {e}")

if __name__ == '__main__':
    inject_favicon('resources/views')
