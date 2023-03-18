<table class="table table-hover table-borderless">
    <thead>
        <tr>
            <th scope="col">Station</th>
            <th scope="col">Address</th>
            <th scope="col">Charger type</th>
            <th scope="col">Created at</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($stations as $station)
            <tr class="cursor-pointer row-item" data-item='@json($station)'>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="row-image me-2">
                            <img width="50" height="50" class="rounded-circle object-fit-cover" src="{{ $station->image_url }}" alt="">
                        </div>
                        <div class="">
                            <p class="mb-0">{{ $station->name }}</p>
                        </div>
                    </div>
                </td>
                <td>{{ $station->address ?: 'Unknown' }}</td>
                <td>{{ $station->charger_type ?: 'Unknown' }}</td>
                <td>{{ $station->created_at->format('d M, Y') }}</td>
            </tr>
        @empty
            <tr class="cursor-pointer">
                <td scope="row" colspan="100%" class="text-center">No station found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
{!! $stations->render('vendor.pagination.default') !!}