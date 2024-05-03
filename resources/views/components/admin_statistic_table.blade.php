<div class="table-responsive">
    <table class="table table-hover align-middle border-0">
        <thead class="small table-info">
            <tr>
                <th scope="col">#</th>
                @foreach ($data['months'] as $month)
                    <th scope="col">{{ $month }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($data['attributes'] as $attribute)
                <tr>
                    <th scope="row">{{ $attribute }}</th>
                    @foreach ($data['months'] as $month)
                        <td>{{ $data['numericalDataNumByAttribute'][$attribute][$month] ?? 'N/A' }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>