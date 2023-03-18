<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
    <div class="flex justify-between flex-1 sm:hidden">
        @if ($paginator->onFirstPage())
        <a href="#" class="btn rounded-1 shadow-none border-0 btn-primary  ms-auto disabled">{!! __('pagination.previous') !!}</a>
        @else
        <a href="{{ $paginator->previousPageUrl() }}" class="btn rounded-1 shadow-none border-0 btn-primary  ms-auto">{!! __('pagination.previous') !!}</a>
        @endif

        @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="btn rounded-1 shadow-none border-0 btn-primary  ms-auto">{!! __('pagination.next') !!}</a>
        @else
        <a href="#" class="btn rounded-1 shadow-none border-0 btn-primary  ms-auto disabled ">{!! __('pagination.next') !!}</a>
        @endif
    </div>

    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between mt-3">
        <div>
            <p class="text-sm text-gray-700 leading-5 mb-0">
                {!! __('Showing') !!}
                @if ($paginator->firstItem())
                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                {!! __('to') !!}
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                @else
                {{ $paginator->count() }}
                @endif
                {!! __('of') !!}
                <span class="font-medium">{{ $paginator->total() }}</span>
                {!! __('results') !!}
            </p>
        </div>
    </div>
</nav>