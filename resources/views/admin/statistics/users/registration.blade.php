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

    <div class="chart-container">
        <canvas id="myChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var colors = ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(54, 162, 235, 0.2)'];
    var borderColors = ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)', 'rgba(255, 206, 86, 1)', 'rgba(54, 162, 235, 1)'];
    var datasets = @json($registrationDataByDefault['attributes']).map(function(attribute, index) {
        return {
            label: attribute,
            data: @json($registrationDataByDefault['months']).map(function(month) {
                return @json($registrationDataByDefault['statisticalData'])[attribute][month] || 0;
            }),
            backgroundColor: colors[index % colors.length],
            borderColor: borderColors[index % borderColors.length],
            borderWidth: 1
        };
    });
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($registrationDataByDefault['months']),
            datasets: datasets
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                }
            }
        }
    });
</script>