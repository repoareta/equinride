@unless ($breadcrumbs->isEmpty())

    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        @foreach ($breadcrumbs as $breadcrumb)

            @if (!is_null($breadcrumb->url) && !$loop->last)
                <li class="breadcrumb-item">
                    <a href="{{ $breadcrumb->url }}" class="text-dark font-weight-bold">
                        {{ $breadcrumb->title }}
                    </a>
                </li>
            @else
                <li class="breadcrumb-item active">
                    {{ $breadcrumb->title }}
                </li>
            @endif

        @endforeach
    </ul>

@endunless