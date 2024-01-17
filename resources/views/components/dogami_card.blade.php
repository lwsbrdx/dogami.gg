<a href="{{ route('dogamis.one', $dogami->nftId) }}" class="w-min">
    <div class="bg-[#2d123b] p-3 flex flex-col border rounded-md border-[#23102d] w-32 h-56 sm:w-40 sm:h-64 transition-all shadow-none shadow-zinc-950 hover:shadow-2xl hover:shadow-zinc-950">
        <img class="rounded-t-md pb-2" src="{{ $dogami->image }}" alt="{{ $dogami->name }}">
        <p class="text-center">{{ $dogami->name }}</p>
        @if ($dogami->isPuppy)
            <p class="text-center"> Level : {{ $dogami->level }}</p>
            <p class="text-center">{{ $dogami->breed->name }}</p>
        @endif
    </div>
</a>
