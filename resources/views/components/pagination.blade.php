<div class="flex flex-col items-center">
    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
        @if ($page - 1 > 0)
            <a href="?page={{ $page - 1 }}" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                <span class="sr-only">Previous</span>
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                </svg>
            </a>
        @endif
        @if ($page != 1)
            <a href="?page=1" class="relative items-center px-4 py-2 text-sm font-semibold text-white ring-1 ring-inset ring-gray-300 hover:bg-gray-50 hover:text-[#230235] focus:z-20 focus:outline-offset-0 inline-flex">
                1
            </a>
        @endif
        @if ($page - 2 > 1)
            <a href="?page={{ $page - 2 }}" class="relative hidden md:inline-flex items-center px-4 py-2 text-sm font-semibold text-white ring-1 ring-inset ring-gray-300 hover:bg-gray-50 hover:text-[#230235] focus:z-20 focus:outline-offset-0">
                {{ $page - 2 }}
            </a>
        @endif
        @if ($page - 1 > 1)
            <a href="?page={{ $page - 1 }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-white ring-1 ring-inset ring-gray-300 hover:bg-gray-50 hover:text-[#230235] focus:z-20 focus:outline-offset-0">
                {{ $page - 1 }}
            </a>
        @endif
        <a href="#" aria-current="page" @class([
            'relative z-10 inline-flex items-center bg-purple-900 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600',
            'rounded-l-md' => $page - 1 <= 0,
            'rounded-r-md' => $page + 1 >= $lastPage,
        ])>
            {{ $page }}
        </a>
        @if ($page + 1 < $lastPage)
            <a href="?page={{ $page + 1 }}" class="relative items-center px-4 py-2 text-sm font-semibold text-white ring-1 ring-inset ring-gray-300 hover:bg-gray-50 hover:text-[#230235] focus:z-20 focus:outline-offset-0 md:inline-flex">
                {{ $page + 1 }}
            </a>
        @endif
        @if ($page + 2 < $lastPage)
            <a href="?page={{ $page + 2 }}" class="relative hidden items-center px-4 py-2 text-sm font-semibold text-white ring-1 ring-inset ring-gray-300 hover:bg-gray-50 hover:text-[#230235] focus:z-20 focus:outline-offset-0 md:inline-flex">
                {{ $page + 2 }}
            </a>
        @endif
        @if ($page != $lastPage)
            <a href="?page={{ $lastPage }}" class="relative items-center px-4 py-2 text-sm font-semibold text-white ring-1 ring-inset ring-gray-300 hover:bg-gray-50 hover:text-[#230235] focus:z-20 focus:outline-offset-0 md:inline-flex">
                {{ $lastPage }}
            </a>
        @endif
        @if ($page + 1 < $lastPage)
            <a href="?page={{ $page + 1 }}" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                <span class="sr-only">Next</span>
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                </svg>
            </a>
        @endif
    </nav>
</div>
