<?php

namespace App\Http\Controllers\Admin;

include __DIR__ . '/../../../../resources/views/admin/statistics/SampleData.php';

/* Following namespace import statement will be used at the phase of backend
use Apps\Models\User;
use Apps\Models\Reservation;
use Apps\Models\Attribute;
*/
namespace App\Http\Controllers\admin;

include __DIR__ . '/../../../../resources/views/admin/statistics/SampleData.php';

/* Following namespace import statement will be used at the phase of backend
use Apps\Models\User;
use Apps\Models\Reservation;
use Apps\Models\Attribute;
*/

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    /* Following constant variables and constructors will be used at the phase of backend
    private $user;
    private $reservation;
    private $attribute;

    public function__construct(User $user, Reservation $reservation, Attribute $attribute){
        $this->user = $user;
        $this->reservation = $reservation;
        $this->attribute = $attribute;
    }
    */

    CONST MONTH_MAP = ['1' => 'Jan', '2' => 'Feb', '3' => 'Mar', '4' => 'Apr', '5' => 'May', '6' => 'Jun', '7' => 'Jul', '8' => 'Aug', '9' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'];

    
    /* Following function will be used at the phase of backend to get the registration number from users table
    public function fetchRegistrationData($selectedYear){
        $months = self::MONTH_MAP;

        // Get all unique attributes from the users table
        //This might be modified to use eloquent relationship between User and Attribute
        $attributes = $this->user
            ->join('attributes', 'users.attribute_id', '=', 'attributes.id')
            ->select('attributes.id', 'attributes.name')
            ->distinct()
            ->get();

        $yearlyData = $this->user->whereYear('created_at', $selectedYear)->get();

        // Initialize an array to hold the results
        $numericalDataNumByAttribute = [];

        // Loop through each attribute
        foreach($attributes as $attribute) {
            // Loop through each month
            foreach($months as $monthNumber => $monthName) {
                // Query the database
                $count = $yearlyData->where('attribute_id', $attribute->id)
                    ->whereMonth('created_at', $monthNumber)
                    ->count();

                // Store the result in the results array
                $numericalDataNumByAttribute[$attribute->name][$monthName] = $count;
            }
        }

        // Convert the results array to an object
        $fetchedData = [
            'year' => $selectedYear,
            'months' => array_values($months),
            'attributes' => $attributes->pluck('name')->toArray(),
            'numericalDataNumByAttribute' => $numericalDataNumByAttribute,
        ];

        return response()->json($fetchedData);
    }
    */
    
    /**
     * Show the statistics page.
     *
     * This method fetches the registration data by default and passes it to the 'admin.statistics.show' view.
     */
    public function showStatisticsTest(){
        $defaultData = getDefaultData();
        return view('admin.statistics.show',['data' => $defaultData]);
    }
    
    public function fetchRegistrationDataTest(Request $request){
        $selectedYear = $request->input('year');
        $sampleFetchedDataRegistrations = getSampleFetchedDataRegistrations($selectedYear);
        return response()->json($sampleFetchedDataRegistrations);
    }
    
    public function fetchDeletionDataTest(Request $request){
        $selectedYear = $request->input('year');
        $sampleFetchedDataDeletions = getSampleFetchedDataDeletions($selectedYear);
        return response()->json($sampleFetchedDataDeletions);
    }

    public function fetchReservationDataTest(Request $request){
        $selectedYear = $request->input('year');
        $sampleFetchedDataReservations = getSampleFetchedDataReservations($selectedYear);
        return response()->json($sampleFetchedDataReservations);
    }

    public function fetchCancellationDataTest(Request $request){
        $selectedYear = $request->input('year');
        $sampleFetchedDataCancellations = getSampleFetchedDataCancellations($selectedYear);
        return response()->json($sampleFetchedDataCancellations);
    }

    public function fetchSaleDataTest(Request $request){
        $selectedYear = $request->input('year');
        $sampleFetchedDataSales = getSampleFetchedDataSales($selectedYear);
        return response()->json($sampleFetchedDataSales);
    }
}