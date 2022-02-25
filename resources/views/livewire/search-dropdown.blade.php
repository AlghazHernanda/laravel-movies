{{-- menggunakan alpine.js dengan x-data dan lain lain, @clikaway berfungsi untuk jika drop down turun lalu kita tinggal klik
    layar lain untuk mengcancle --}}

<div class="relative mt-3 md:mt-0" x-data="{isOpen:true}" @click.away="isOpen = false">
    <input 
    wire:model.debounce.500ms="search" 
    type="text"
    class="bg-zinc-800 text-sm rounded-full w64 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline" 
    placeholder="Search"
    x-ref="search"
    @keydown.window="
        if (event.keyCode === 191){
            event.preventDefault();
            $refs.search.focus(); {{-- agar saat lagi ga di search bar, trus tiba-tiba pencet slahs, makan akan langsung
                ke search bar --}}
        }
    "
    @focus="isOpen = true" {{-- focus agar saat di pencet lagi dropdown nya, film nya muncul lagi, dan jadi lebih responsive --}}
    @keydown="isOpen = true"
    @keydown.escape.window="isOpen = false"  {{-- keydown escape agar saat di pencet esc, dropdown nya ilang --}}
    @keydown.shift.tab="isOpen = false" {{-- fokus nya pada searchbar akan hilang saat kita pencet tab da fokus ke hal lain --}}
    >
    
    <div class="absolute top-0">
        <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" viewBox="0 0 24 24"><path class="heroicon-ui" d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/></svg>
    </div>

    {{-- untuk icon loading --}}
    <div wire:loading class="spinner top-0 right-0 mr-4 mt-3"></div>

    @if (strlen($search) >= 2)
        <div
            class="z-50 absolute bg-zinc-800 text-sm rounded w-64 mt-4"
            x-show.transition.opacity="isOpen"
            
            >
            @if ($searchResults->count() > 0)
                <ul>
                    @foreach ($searchResults as $result)
                        <li class="border-b border-gray-700">
                            <a
                                href="{{ route('movies.show', $result['id']) }}" class="block hover:bg-zinc-700 px-3 py-3 flex items-center transition ease-in-out duration-150"
                                @if ($loop->last) @keydown.tab="isOpen = false" @endif
                            >
                            @if ($result['poster_path'])
                                <img src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}" alt="poster" class="w-8">
                            @else
                                <img src="https://via.placeholder.com/50x75" alt="poster" class="w-8">
                            @endif
                            <span class="ml-4">{{ $result['title'] }}</span>
                        </a>
                        </li>
                    @endforeach

                </ul>
            @else
                <div class="px-3 py-3">No results for "{{ $search }}"</div>
            @endif
        </div>
    @endif
</div>
