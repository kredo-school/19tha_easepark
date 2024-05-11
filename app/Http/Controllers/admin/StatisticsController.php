<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Attribute;
use App\Models\Area;

class StatisticsController extends Controller
{
    private $user;
    private $reservation;
    private $attribute;
    private $area;

    public function __construct(User $user, Reservation $reservation, Attribute $attribute, Area $area){
        $this->user = $user;
        $this->reservation = $reservation;
        $this->attribute = $attribute;
        $this->area = $area;
    }

    CONST MONTH_MAP = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'];

    public function showStatistics(){
        return view('admin.statistics.show');
    }

    public function fetchYearlyStatisticalData(Request $request){
        $months = self::MONTH_MAP;
        $selectedYear = $request->selectedYear;
        $selectedTableId = $request->selectedTableId;
    
        $tableIdMethodMap = [
            'registrations-num' => 
                [
                    'yearlyDataFetchMethod' => 'fetchYearlyRegistrationsData', 'table' => 'users', 
                    'statisticalDataFetchMethod' => 'fetchRegistrationsStatisticalData'
                ],
            'deletions-num' => 
                [
                    'yearlyDataFetchMethod' => 'fetchYearlyDeletionsData', 
                    'table' => 'users', 
                    'statisticalDataFetchMethod' => 'fetchDeletionsStatisticalData'
                ],
            'reservations-num' => 
                [
                    'yearlyDataFetchMethod' => 'fetchYearlyReservationsData', 'table' => 'reservations', 
                    'statisticalDataFetchMethod' => 'fetchReservationsStatisticalData'
                ],
            'cancellations-num' => 
                [
                    'yearlyDataFetchMethod' => 'fetchYearlyCancellationsData', 'table' => 'reservations', 
                    'statisticalDataFetchMethod' => 'fetchCancellationsStatisticalData'
                ],
            'sales-num' => 
                [
                    'yearlyDataFetchMethod' => 'fetchYearlySalesData', 
                    'table' => 'reservations', 
                    'statisticalDataFetchMethod' => 'fetchSalesStatisticalData'
                ],
        ];
    
        if (!array_key_exists($selectedTableId, $tableIdMethodMap)) {
            return response()->json(['error' => 'Invalid table ID']);
        }
    
        $yearlyDataFetchMethod = $tableIdMethodMap[$selectedTableId]['yearlyDataFetchMethod'];
        $table = $tableIdMethodMap[$selectedTableId]['table'];
        $statisticalDataFetchMethod = $tableIdMethodMap[$selectedTableId]['statisticalDataFetchMethod'];

        $attributes = $this->getAttributes($table);
        $yearlyData = $this->$yearlyDataFetchMethod($selectedYear);
        $statisticalData = $this->$statisticalDataFetchMethod($attributes, $months, $yearlyData, $selectedTableId);
    
        // Add "Total" attribute
        $statisticalData['Total'] = [];
        foreach($months as $monthName) {
            $total = 0;
            foreach($attributes as $attribute) {
                $total += $statisticalData[$attribute->name][$monthName];
            }
            $statisticalData['Total'][$monthName] = $total;
        }
    
        // Convert the results array to an object
        $fetchedData = [
            'months' => array_values($months),
            'attributes' => array_merge($attributes->pluck('name')->toArray(), ['Total']),
            'statisticalData' => $statisticalData,
        ];
        return response()->json($fetchedData);
    }
    
    private function getAttributes($table) {
        if($table === 'users'){
            $attributes = $this->attribute->whereIn('id', function($query) {
                $query->select('attribute_id')->from($this->user->getTable())->distinct();
            })->get();
        } else if ($table === 'reservations'){
            $attributes = $this->attribute->whereIn('id', function($query) {
                $query->select('attribute_id')
                    ->from($this->area->getTable())
                    ->whereIn('id', function($subQuery) {
                        $subQuery->select('area_id')->from($this->reservation->getTable())->distinct();
                    })
                    ->distinct();
            })->get();
        }
        return $attributes;
    }

    private function fetchYearlyRegistrationsData($selectedYear) {
        return $this->user->whereYear('created_at', $selectedYear)->whereNull('deleted_at');
    }

    private function fetchYearlyDeletionsData($selectedYear) {
        return $this->user->onlyTrashed()->whereYear('deleted_at', $selectedYear);
    }

    private function fetchYearlyReservationsData($selectedYear) {
        return $this->reservation->whereYear('date', $selectedYear)->whereNull('deleted_at');
    }

    private function fetchYearlyCancellationsData($selectedYear) {
        return $this->reservation->onlyTrashed()->whereYear('deleted_at', $selectedYear);
    }

    private function fetchYearlySalesData($selectedYear) {
        return $this->reservation->whereYear('date', $selectedYear)->whereNull('deleted_at');
    }

    private function fetchRegistrationsStatisticalData($attributes, $months, $yearlyData, $selectedTableId) {
        $data = [];
        foreach($attributes as $attribute) {
            foreach($months as $monthNumber => $monthName) {
                $query = clone $yearlyData;
                $count = $query
                    ->where('attribute_id', $attribute->id)
                    ->whereMonth('created_at', $monthNumber)
                    ->count();
                $data[$attribute->name][$monthName] = $count;
            }
        }
        return $data;
    }

    private function fetchDeletionsStatisticalData($attributes, $months, $yearlyData, $selectedTableId) {
        $data = [];
        foreach($attributes as $attribute) {
            foreach($months as $monthNumber => $monthName) {
                $query = clone $yearlyData;
                $count = $query
                    ->where('attribute_id', $attribute->id)
                    ->whereMonth('deleted_at', $monthNumber)
                    ->count();
                $data[$attribute->name][$monthName] = $count;
            }
        }
        return $data;
    }

    private function fetchReservationsStatisticalData($attributes, $months, $yearlyData, $selectedTableId) {
        $data = [];
        foreach($attributes as $attribute) {
            foreach($months as $monthNumber => $monthName) {
                $query = clone $yearlyData;
                $count = $query
                    ->whereHas('area', function ($query) use ($attribute, $monthNumber) {
                        $query->where('attribute_id', $attribute->id);
                    })
                    ->whereMonth('date', $monthNumber)
                    ->count();
                $data[$attribute->name][$monthName] = $count;
            }
        }
        return $data;
    }

    private function fetchCancellationsStatisticalData($attributes, $months, $yearlyData, $selectedTableId) {
        $data = [];
        foreach($attributes as $attribute) {
            foreach($months as $monthNumber => $monthName) {
                $query = clone $yearlyData;
                $count = $query
                    ->whereHas('area', function ($query) use ($attribute, $monthNumber) {
                        $query->where('attribute_id', $attribute->id);
                    })
                    ->whereMonth('deleted_at', $monthNumber)
                    ->count();
                    $data[$attribute->name][$monthName] = $count;
            }
        }
        return $data;
    }

    private function fetchSalesStatisticalData($attributes, $months, $yearlyData, $selectedTableId) {
        $data = [];
        foreach($attributes as $attribute) {
            foreach($months as $monthNumber => $monthName) {
                $query = clone $yearlyData;
                $count = $query
                    ->whereHas('area', function ($query) use ($attribute, $monthNumber) {
                        $query->where('attribute_id', $attribute->id);
                    })
                    ->whereMonth('date', $monthNumber)
                    ->sum('fee_log');
                    $data[$attribute->name][$monthName] = $count;
            }
        }
        return $data;
    }
}