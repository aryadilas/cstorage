<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  
    <div class="flex min-h-screen w-full items-center justify-center bg-blue-200">
        <div class="w-full max-w-sm rounded-md border border-black bg-white p-2">
            <h1 class="mb-3 text-center text-xl font-semibold"><span class="animate-pulse">✨</span> Code Storage <span class="animate-pulse">✨</span></h1>
            <p class="px-2 mb-3 leading-4 tracking-tighter text-justify">
                Ini adalah web untuk menyimpan code, 
                dapat digunakan untuk membuat catatan code, cheatsheet, maupun dokumentasi code. 
                Aplikasi ini mensupport berbagai macam bahasa pemrograman.
            </p>
            <div class="w-full text-center mt-2 mb-10">
                <form action="/" method="POST">
                    @csrf
                    
                        <input type="text" name="name" placeholder="Folder Name" class="outline-none ">
                        <input type="submit" value="➕" class="cursor-pointer">
                    
                </form>
            </div>
            <div class="flex gap-2 justify-center h-full w-full px-2 mb-2 flex-wrap text-blue-900">
                @foreach ($data as $data)
                
                <a href="{{ "/cheat/".$data->id }}" class="flex-grow flex-shrink">
                    <div class="p-2 border border-blue-900 flex items-center justify-center bg-white ">
                        {{ $data->name }}
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>

</body>
</html>