<div data-popover id="popover-bottom" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-xs opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
    <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
        <h3 class="font-semibold text-gray-900 dark:text-white">Activity log</h3>
    </div>
    <div class="px-3 py-2 max-h-80 overflow-y-scroll">

    <ol class="relative border-s border-gray-200 dark:border-gray-700">       
        @foreach ($logs as $log)
        <li class="mb-10 ms-3">
            <p class="text-sm font-normal text-white">{{ $log->created_at  }}</p>            
            <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">{{ $log->description  }}</p>
        </li>
        @endforeach
    </ol>

    </div>
    <div data-popper-arrow></div>
</div>