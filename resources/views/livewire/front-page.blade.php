{{-- <div class="divide-y divide-gray-800" x-data="{ showText: false, randomVariable: 'Random Text' }"> --}}
<div class="divide-y divide-gray-800" x-data="{ show: false }">
    <nav class="flex items-center bg-gray-900 px-3 py-2 shadow-lg">
        <div>
            <button 
                @click="show =! show" 
                {{-- @click="show ? show = false : show = true"  --}}
                class="block h-8 mr-3 text-gray-400 items-center hover:text-gray-200 focus:text-gray-200 focus:outline-none sm:hidden">
                    <svg class="w-8 fill-current" viewBox="0 0 24 24">                            
                        <path x-show="!show" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
                        <path x-show="show" fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                    </svg>

            </button>
        </div>
        <div class="h-12 w-full flex items-center">
            <a href="{{ url('/') }}" class="w-full">
                <img class="h-8" src="{{ url('img/jetstream-logo.svg') }}" alt="">
            </a>
        </div>
        <div class="flex justify-end">
            {{-- Top Navigation  --}}
            
            <ul class="hidden sm:flex sm:text-left text-gray-200 text-xs">
                @foreach ($topNavLinks as $link)
                        <a href="{{ url('/'.$link->slug) }}">
                            <li class="cusor-pointer px-4 py-2 hover:bg-gray-800">{{ $link->label }}</li>
                        </a>
                    @endforeach
                <li class="cusor-pointer px-4 py-2 hover:underline">
                    <a href="{{ url('/login')}}">Login</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="sm:flex sm:min-h-screen">
        <aside class="bg-gray-900 text-gray-700 divide-y divide-gray-600 divide-dashed sm:w-4/12 md:w-3/12 lg:w-2/12">
            {{-- Desktop Web View --}}
            <ul class="hidden text-gray-200 sm:block sm:text-left">
                @foreach ($sideBarLinks as $link)
                    {{-- <li class="cusor-pointer px-4 py-2 hover:bg-gray-800">
                        <a href="{{ url('/'.$link->slug) }}">{{ $link->label }}</a>
                    </li> --}}
                    <a href="{{ url('/'.$link->slug) }}">
                        <li class="cusor-pointer px-4 py-2 hover:bg-gray-800">{{ $link->label }}</li>
                    </a>
                @endforeach
            </ul>

            {{-- Mobile Web View --}}
            <div :class="show ? 'block' : 'hidden'" class="pb-3 divide-y divide-gray-800 block sm:hidden">
                <ul class="text-gray-200 text-xs">
                    @foreach ($sideBarLinks as $link)
                        <a href="{{ url('/'.$link->slug) }}">
                            <li class="cusor-pointer px-4 py-2 hover:bg-gray-800">{{ $link->label }}</li>
                        </a>
                    @endforeach
                </ul>

                {{-- Top Navigation Mobile Web View --}}
                <ul class="text-gray-200 text-xs">
                    @foreach ($topNavLinks as $link)
                        <a href="{{ url('/'.$link->slug) }}">
                            <li class="cusor-pointer px-4 py-2 hover:bg-gray-800">{{ $link->label }}</li>
                        </a>
                    @endforeach
                    <li class="cusor-pointer px-4 py-2 hover:bg-gray-800">
                        <a href="{{ url('/login')}}">Login</a>
                    </li>
                </ul>
            </div>
        </aside>
        <main class="bg-gray-100 p-12 min-h-screen sm:w-8/12 md:w-9/12 lg:w-10/12">
            <section class="divide-y text-gray-900">
                {{-- <div x-text="show == true ? 'True' : 'False'"></div> --}}
                <h1 class="text-3xl font-bold">{{ $title }}</h1>
                <article>
                    <div class="mt-5 text-sm">
                        {!! $content !!}
                    </div>
                </article>
                {{-- <button 
                    @click="showText = true; 
                    randomVariable='Any Text';
                    alert('Hey!');" 
                    :class="showText ? 'bg-red-900' : 'bg-yellow-500' "
                    class="bg-green-500 p-3 text-white">show</button>

                <button @click="showText = false; randomVariable='Nyuethyue';" class="bg-gray-500 p-3 text-white mb-4">Hide</button>

                <div x-show="showText">Show when the showText variable is true</div>
                <div x-show="!showText">Hid when the showText variable is false</div>

                <div x-text="randomVariable"></div> --}}
            </section>
        </main>
    </div>
</div>

{{-- <div>
    <div class="border p-5 text-gray-100 bg-gray-500 text-3xl sm:bg-blue-500 md:bg-red-500 lg:bg-yello-500">
        {{ $title }}
    </div>
    
    <div class="lg:flex">
        <div class="p-5 border text-center sm:text-left lg:w-1/2">
            {!! $content !!}
        </div>
        <div class="boder bg-gray-400 lg:w-1/2">
            <img class="p-2 w-full h-full object-cover object-center" src="{{ 'img/king.jpg'}}" alt="" />
        </div>
    </div>   
</div> --}}
