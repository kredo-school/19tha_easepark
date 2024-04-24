<div class="form-group w-25">
    <select class="form-control my-2" id="year">
        @for ($year = date('Y'); $year >= 2000; $year--)
            <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ $year }}</option>
        @endfor
    </select>
</div>
<div class="table-responsive">
    <table class="table table-hover align-middle border-0">
        <thead class="small table-info">
            <tr>
                <th scope="col">#</th>
                @foreach ($registrationDataByDefault['months'] as $month)
                    <th scope="col">{{ $month }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($registrationDataByDefault['attributes'] as $attribute)
                <tr>
                    <th scope="row">{{ $attribute }}</th>
                    @foreach ($registrationDataByDefault['months'] as $month)
                        <td>{{ $registrationDataByDefault['statisticalData'][$attribute][$month] ?? 'N/A' }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>
    .form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='4' height='5' viewBox='0 0 4 5'%3E%3Cpath fill='%23333' d='M2 0L0 2h4zm0 5L0 3h4z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right .75rem center;
        background-size: 8px 10px;
    }
</style>