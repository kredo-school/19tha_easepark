{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title>PDF Download</title>
</head>

<body>
    <div class="mx-2 my-3">
        <img src="{{ public_path('images/8C8FAB4E-E713-45F0-839A-5064D27EDBAA.png') }}" alt="Logo" width="80"
            class="img-fluid pdf_logo">


        <div class="col">
            <h1 class="mt-3 mb-0">Reservation List </h1>
        </div>
    </div>
    <div class="mx-2">Download Date: {{ date('Y-m-d') }}</div>
    <div class="mx-2">User Name: {{ Auth::user()->name }}</div>

    <div class="">
        <table class="table">
            <thead>
                <tr class="table-info">
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col" class="text-center">Area</th>
                    <th scope="col" class="text-center">Date</th>
                    <th scope="col" class="text-center">Type</th>
                    <th scope="col" class="text-center">Fee</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row" class="text-center">1</th>
                    <td class="text-center">Area D, 2F</td>
                    <td class="text-center">March 18(Sun)</td>
                    <td class="text-center">Disability</td>
                    <td class="text-center">$20</td>
                </tr>
            </tbody>
        </table>

        </table>

    </div>

</body>

</html> --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Download</title>
</head>
<body>
    <div style="margin: 16px;">
        <img src="{{ public_path('images/8C8FAB4E-E713-45F0-839A-5064D27EDBAA.png') }}" alt="Logo" width="80" style="display: block; margin: 0 auto;">

        <h1 style="margin-top: 24px; margin-bottom: 8px;">Reservation List</h1>
    </div>

    <div style="margin: 16px;">
        <div>Download Date: {{ date('Y-m-d') }}</div>
        <div>User Name: {{ Auth::user()->name }}</div>
    </div>

    <div style="margin: 16px;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f0f0f0; text-align: center;">
                    <th scope="col" style="border: 1px solid #ccc; padding: 8px;">ID</th>
                    <th scope="col" style="border: 1px solid #ccc; padding: 8px;">Area</th>
                    <th scope="col" style="border: 1px solid #ccc; padding: 8px;">Date</th>
                    <th scope="col" style="border: 1px solid #ccc; padding: 8px;">Type</th>
                    <th scope="col" style="border: 1px solid #ccc; padding: 8px;">Fee</th>
                </tr>
            </thead>
            <tbody>
                <tr style="text-align: center;">
                    <th scope="row" style="border: 1px solid #ccc; padding: 8px;">1</th>
                    <td style="border: 1px solid #ccc; padding: 8px;">Area D, 2F</td>
                    <td style="border: 1px solid #ccc; padding: 8px;">March 18 (Sun)</td>
                    <td style="border: 1px solid #ccc; padding: 8px;">Disability</td>
                    <td style="border: 1px solid #ccc; padding: 8px;">$20</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
