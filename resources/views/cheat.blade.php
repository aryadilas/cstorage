<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="{{ asset('prism/prism.css') }}" rel="stylesheet" />
</head>
<body id="body">
    <div class="w-full bg-slate-50 items-center px-5 py-2 fixed z-10 flex justify-between shadow">
        <a href="/" class="border border-slate-400 w-fit px-2 py-1 flex gap-1"> ⬅️ <span class="hidden sm:block">Back</span> </a>

        {{-- <div class="border items-center flex justify-center"> --}}
            <h1 class="px-2 sm:px-12 border-slate-400 max-w-[17ch] break-words sm:max-w-full py-1 border font-semibold text-2xl"> {{$folder->name}} </h1>
        {{-- </div> --}}

        <form action="/{{$folder->id}}" method="POST">
            @csrf
            @method('delete')
            <div class="border border-slate-400 px-2 py-1 items-center flex justify-center gap-6">
                {{-- <h1 class=" font-semibold text-xl"> {{$folder->name}} </h1> --}}
                <span class="cursor-pointer flex gap-1" onclick="toggleInsertModal();">➕ <span class="hidden sm:block">Add</span></span>
                <input type="submit" value="🗑️" class="cursor-pointer sm:hidden">
                <input type="submit" value="🗑️ Delete" class="cursor-pointer hidden sm:block">
                
            </div>
        </form>
    </div>

    <div class="flex flex-col min-h-screen max-w-screen justify-center items-center w-full px-4 pb-4 pt-24 border bg-blue-200">
        
        {{-- <div id="sortablelist" class="w-full gap-2 flex flex-wrap "> --}}
        {{-- <div id="sortablelist" class="w-full gap-2 grid   grid-flow-row grid-flow-row grid-cols-3 auto-rows-max"> --}}
        {{-- <div id="sortablelist" class="w-full grid grid-cols-1 md:grid-cols-2 gap-2"> --}}
        {{-- <div id="sortablelist" class="w-full flex justify-center align-center gap-2"> --}}
        <div id="sortablelist" class="w-full flex  mx-auto  ">
                
            {{-- @php dd($folder->sheets) @endphp --}}
            @php
                $index = 0;
                $position = 0;
            @endphp
            @forelse ($data as $row)
                
            {{-- <div class="flex flex-col gap-2 bg-slate-50 border max-w-full rounded-md p-2 flex-grow flex-shrink max-h-[10rem] "> --}}
                
            {{-- @if ( $index%4 == 0 )
                <div class="flex flex-col gap-2">
            @endif --}}
            



            <div class="box-border flex flex-col gap-2 bg-slate-50 border rounded-md p-2 item h-fit max-w-sm sm:max-w-[28rem] w-full mb-[10px]">

                <div class="flex justify-between gap-2 items-center">
                    <div class="drag-point cursor-all-scroll flex flex-grow justify-between border-2 rounded-md border-red-200 items-center">
                        <h1 class="font-semibold py-1 px-2 text-xl">{{ $row->title }}</h1>
                        <h1 class="bg-red-200 px-2 h-full">{{ strtoupper($row->language) }}</h1>
                    </div>


                    <div class="flex flex-col gap-4 sm:gap-2">

                        <div id="{{"code".$row->id}}" class="text-xs cursor-pointer gap-1 group flex items-center">
                            <p  class="" onclick="copyToClipboard(event)">📋</p>
                            <p class="hidden sm:block" onclick="copyToClipboard(event)">Copy</p>
                        </div>

                        <div id="{{$row->id}}" class="text-xs cursor-pointer gap-1 group flex items-center">
                            <p  class=""  onclick="loadData(event)">✏️</p>
                            <p class="hidden sm:block"  onclick="loadData(event)">Edit</p>
                        </div>
                        
                        <form action="/cheat/{{ $row->id }}" method="POST">
                            @csrf
                            @method('delete')
                            <input class="text-xs cursor-pointer sm:hidden" type="submit" value="🗑️">
                            <input class="text-xs cursor-pointer hidden sm:block" type="submit" value="🗑️ Delete">
                        </form>

                    </div>
                </div>

                <div class="flex justify-between">
                    <p class="text-sm w-full ">{{ $row->description }}</p>
                    <p class="text-xs bg-gray-200 p-1 cursor-pointer rounded-sm font-semibold" onclick="toggleContainer('{{ 'codeContainer'.$row->id }}')">SHOW</p>
                </div>
                
                <div class="flex-grow" id="{{ "codeContainer".$row->id }}">
                
                    <div class="py-3 px-1 bg-gray-900 opacity-90 rounded-md w-full {{"code".$row->id}}">
                        <pre class="text-gray-100 px-2 font-mono leading-5 text-sm max-h-[70ch] overflow-auto"><code class=" language-{{ $row->language }}">{{ $row->code }}</code></pre>
                    </div>
                
                </div>

            </div>




            {{-- @php
                if ($index%4 == 0) {
                    $position = $index;    
                }
            @endphp --}}

            {{-- @if ( $index == $position+3  )
                </div>
            @endif --}}

            @php
                $index++;
            @endphp
            
            @empty
            <div class=" w-full h-[70vh] flex justify-center items-center">
                <p class="bg-slate-50 p-4">Empty Folder...!</p>
            </div>
            @endforelse
      
        </div>
    </div>
    
    <form action="/cheat/{{ $folder->id }}" method="POST">
        @csrf
        <div class="w-full h-full hidden fixed bg-white px-4 top-0 left-0 flex justify-center items-center duration-1000 transition" id="insertModal">
            <div class=" w-full h-full absolute z-0" onclick="toggleInsertModal();"></div>
            <div class="flex flex-col gap-2 bg-white border z-10 rounded-md w-full max-w-lg p-2">
                <div class="flex justify-between gap-2">
                    <h1 class="font-semibold flex-grow border-2 py-1 px-2 rounded-md border-blue-200">Insert Form</h1>
                    <div class="flex gap-2 items-center">
                        <input type="submit" value="💾" class="cursor-pointer">
                        <p class="cursor-pointer" onclick="toggleInsertModal();">❌</p>
                    </div>
                </div>

                
                <input type="text" name="title" placeholder="Title" class="outline-none font-semibold pl-2">
                    
                
                
                <input type="text" name="description" placeholder="Description" class="outline-none text-sm pl-2">

                <Select name="language" class="outline-none pl-1 w-2/3">
                    <option selected disabled>Select Language</option>
                    <option value="plain">PlainText</option>
                    <option value="git">Git</option>
                    <option value="php">PHP</option>
                    <option value="phpdoc">PHPDoc</option>
                    <option value="php">PHP Extras</option>
                    <option value="uri">URI</option>
                    <option value="url">URL</option>
                    <option value="ts">TypeScript</option>
                    <option value="mongodb">MongoDB</option>
                    <option value="markup-templating">Markup templating</option>
                    <option value="sql">SQL</option>
                    <option value="c">C</option>
                    <option value="cs">C#</option>
                    <option value="cpp">C++</option>
                    <option value="jsonp">JSONP</option>
                    <option value="json5">JSON5</option>
                    <option value="json">JSON + Web App Manifest</option>
                    <option value="batch">Batch</option>
                    <option value="javadoclike">JavaDoc-like</option>
                    <option value="java">Java</option>
                    <option value="regex">Regex</option>
                    <option value="ruby">Ruby</option>
                    <option value="tsx">React TSX</option>
                    <option value="jsx">React JSX</option>
                    <option value="ignore">.ignore, .gitignore, .hignore, .npmignore</option>
                    <option value="py">Python</option>
                    <option value="graphql">GraphQL</option>
                    <option value="go">Go</option>
                    <option value="powershell">PowerShell</option>
                    <option value="js">Javascript</option>
                    <option value="cil">C-like</option>
                    <option value="css">CSS</option>
                    <option value="html">HTML</option>
                    <option value="svg">svg</option>
                </Select>
                <div class="flex-grow">
                    <textarea class="bg-gray-900 w-full h-[150px] rounded-md text-gray-100 mb-2 p-2" name="code">Put some code here!</textarea>
                </div>

            </div>
            
        </div>
    </form>

    <form action="#" id="formUpdate" method="POST">
        @method('put')
        @csrf
        <div class="w-full h-full hidden fixed bg-white top-0 left-0 px-4 flex justify-center items-center duration-1000 transition" id="updateModal">
            <div class=" w-full h-full absolute z-0" onclick="toggleUpdateModal();"></div>
            <div class="flex flex-col gap-2 z-10 bg-white border rounded-md w-full max-w-lg p-2">
                <div class="flex justify-between gap-2">
                    <h1 class="font-semibold flex-grow border-2 py-1 px-2 rounded-md border-orange-200">Update Form</h1>
                    <div class="flex gap-2 items-center">
                        <input type="submit" value="💾" class="cursor-pointer">
                        <p class="cursor-pointer" onclick="toggleUpdateModal()">❌</p>
                    </div>
                </div>

                <div class="flex gap-2">
                    <p class="text-gray-400">Title </p>
                    <input id="title" type="text" name="title" placeholder="Title" class="outline-none font-semibold flex-grow">
                </div>
                
                <div class="flex gap-2 items-start">
                    <p class="text-gray-400">Description </p>
                    <textarea id="description" type="text" name="description" placeholder="Description" class="outline-none flex-grow" rows="2"></textarea>
                </div>

                <div class="flex gap-2">
                    <p class="text-gray-400">Language </p>
                    <Select name="language" id="language" class="outline-none w-2/3">
                        <option selected disabled>Select Language</option>
                    </Select>
                </div>

                <div class="flex-grow">
                    <textarea id="code" class="bg-gray-900 w-full h-[150px] rounded-md text-gray-100 mb-2 p-2 language-js" name="code" oninput="updateTextArea(event)"></textarea>
                </div>

            </div>
            
        </div>
    </form>

    <script src="{{ asset('prism/prism (2).js') }}"></script>
    
    <script>
        function toggleContainer($id){
            document.getElementById($id).classList.toggle("hidden");
        }
    </script>

    <script>      
        function updateTextArea(e){
            Prism.highlightAll();
            Prism.highlightElement(e.target);
        }
    </script>

    <script>
        function toggleInsertModal(){
            const insertModal = document.getElementById("insertModal");
            insertModal.classList.toggle("hidden");
            const bodyElement = document.getElementById("body");
            bodyElement.classList.toggle("overflow-hidden");
        }

        function copyToClipboard(e){
            const textarea = document.getElementsByClassName(e.target.parentElement.id);
            const code = textarea[0].children[0].children[0].innerText;
            navigator.clipboard.writeText(decodeURIComponent(code));

        }
    </script>

    <script>
        function toggleUpdateModal(){
            const updateModal = document.getElementById("updateModal");
            updateModal.classList.toggle("hidden");
            const bodyElement = document.getElementById("body");
            bodyElement.classList.toggle("overflow-hidden");
        }

        function loadData(e){
            toggleUpdateModal();    
            
            var langTextOption = ["Git", "PHP", "PHPDoc", "PHP Extras", "URI", "URL", "TypeScript", "MongoDB", "Markup templating", "SQL", "C", "C#", "C++", "JSONP", "JSON5", "JSON + Web App Manifest", "Batch", "JavaDoc-like", "Java", "Regex", "Ruby", "React TSX", "React JSX", ".ignore, .gitignore, .hignore, .npmignore", "Python", "GraphQL", "Go", "PowerShell", "Javascript", "C-like", "CSS", "HTML", "svg"];
            var langValueOption = ["git", "php", "phpdoc", "php", "uri", "url", "ts", "mongodb", "markup-templating", "sql", "c", "cs", "cpp", "jsonp", "json5", "json", "batch", "javadoclike", "java", "regex", "ruby", "tsx", "jsx", "ignore", "py", "graphql", "go", "powershell", "js", "cil", "css", "html", "svg"];
            
            var id = e.target.parentElement.id;

            var title = document.getElementById('title');
            var description = document.getElementById('description');
            var language = document.getElementById('language');
            var code = document.getElementById('code');

            var formUpdate = document.getElementById("formUpdate");
            formUpdate.action = "/sheet/"+id;
            
            
            fetch('/sheet/'+id, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error(response.statusText);
                }
                return response.json();
            })
            .then(function(data) {
                for (let i = 0; i < langTextOption.length; i++) {
                    var option = document.createElement('option');
                    option.value = langValueOption[i];
                    option.textContent = langTextOption[i];
                    
                    if (langValueOption[i] === data.language) {
                        option.selected = true;
                    }
                    
                    language.appendChild(option);

                };
                
                // Mengisi nilai input form dengan data yang diterima
                title.value = data.title;
                description.value = data.description;
                code.value = data.code;
                
            })
            .catch(function(error) {
                console.log(error);
            });
            
        }

        function childLoadData(){

        }
    </script>

    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    
    <script>
        new Sortable(sortablelist, {
            handle: '.drag-point',
            swap: true, 
            swapClass: 'highlight', 
            animation: 150,
            ghostClass: 'sortable-ghost'
        }); 
    </script>

    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
    <!-- or -->
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>

    <script>
        var msnry = new Masonry( '#sortablelist', {
            // columnWidth: 50,
            horizontalOrder: true,
            gutter: 10,
            items: {{ count($data) }},
            resize: true,
            fitWidth: true,
            itemSelector: '.item',
            transitionDuration: '0.8s',
            stagger: '0.03s'
        });
    </script>

</body>
</html>



