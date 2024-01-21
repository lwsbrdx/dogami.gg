<form method="GET" action="{{ route('home') }}" class="flex flex-col sm:flex-row items-center sm:self-end sm:pr-4">
    @csrf

    <label class="relative block">
        <span class="sr-only">Search</span>
        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
            <img class="w-6" src="{{ Vite::asset('resources/assets/images/magnifying-glass.svg') }}" />
        </span>
        <input value="{{ $search }}" class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Search a DOGAMI..." type="text" name="search"/>
    </label>

    <select name="breed" class="h-10 w-56 m-3 pl-2 pr-5 appearance-none border border-[#2d123b] rounded-md focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm">
        <option value="">Breed Filter...</option>
        @foreach (\App\Classes\Dogami\ObjectEnums\DogamiBreed::all() as $breed)
            <option value="{{ $breed->name }}">{{ $breed->name }}</option>
        @endforeach
    </select>

    <div class="mt-3 sm:ml-3 sm:mt-0">
        <button class="bg-[#2d123b] transition border border-[#2d123b] active:border-gray-400 px-6 py-2 rounded-md">
            Search
        </button>
    </div>
</form>
