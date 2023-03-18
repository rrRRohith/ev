<table class="table table-hover table-borderless">
    <thead>
        <tr>
            <th scope="col">Model</th>
            <th scope="col">Charger type</th>
            <th scope="col">Range info</th>
            <th scope="col">Created at</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($cars as $car)
            <tr class="cursor-pointer row-item" data-item='@json($car)'>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="row-image me-2">
                            <img width="50" height="50" class="rounded-circle object-fit-cover" src="{{ $car->image_url }}" alt="">
                        </div>
                        <div class="">
                            <p class="mb-0">{{ $car->make }} {{ $car->name }}</p>
                            <p class="mb-0">{{ $car->trim }}</p>
                        </div>
                    </div>
                </td>
                <td>{{ $car->charger_type ?: 'Unknown' }}</td>
                <td>
                    <div>
                        <p class="mb-0">Range. {{ $car->drive_range }}kms</p>
                        <p class="mb-0 small">Charging time. {{ $car->charging_time }}m</p>
                    </div>
                </td>
                <td>{{ $car->created_at->format('d M, Y') }}</td>
            </tr>
        @empty
            <tr class="cursor-pointer">
                <td scope="row" colspan="100%" class="text-center">No car models found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
{!! $cars->render('vendor.pagination.default') !!}