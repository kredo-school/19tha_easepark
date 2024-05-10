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

    public function fetchStatisticalData(Request $request){
        $months = self::MONTH_MAP;
        $selectedYear = $request->selectedYear;
        $selectedTableId = $request->selectedTableId;
        
        if($selectedTableId === 'registrations-num' || $selectedTableId === 'deletions-num'){
            $attributes = $this->attribute->whereIn('id', function($query) {
                $query->select('attribute_id')->from($this->user->getTable())->distinct();
            })->get();
            switch ($selectedTableId) {
                case 'registrations-num':
                    $yearlyData = $this->user->whereYear('created_at', $selectedYear)->whereNull('deleted_at');
                    break;
                case 'deletions-num':
                    $yearlyData = $this->user->onlyTrashed()->whereYear('created_at', $selectedYear);
                    break;
            }
        } else if ($selectedTableId === 'reservations-num' || $selectedTableId === 'cancellations-num' || $selectedTableId === 'sales-num'){
            $attributes = $this->attribute->whereIn('id', function($query) {
                $query->select('attribute_id')
                    ->from($this->area->getTable())
                    ->whereIn('id', function($subQuery) {
                        $subQuery->select('area_id')->from($this->reservation->getTable())->distinct();
                    })
                    ->distinct();
            })->get();
            switch ($selectedTableId) {
                case 'reservations-num':
                    $yearlyData = $this->reservation->whereYear('date', $selectedYear)->whereNull('deleted_at');
                    break;
                case 'cancellations-num':
                    $yearlyData = $this->reservation->onlyTrashed()->whereYear('date', $selectedYear);
                    break;
                default:
                    $yearlyData = $this->reservation->whereYear('date', $selectedYear)->whereNull('deleted_at');
                    break;
            }
        } else {
            return response()->json(['error' => 'Invalid table ID']);
        }

        // Initialize an array to hold the results
        $numericalDataNumByAttribute = [];
        
        if($selectedTableId === 'registrations-num' || $selectedTableId === 'deletions-num'){
        // Loop through each attribute
        foreach($attributes as $attribute) {
            foreach($months as $monthNumber => $monthName) {
                $query = clone $yearlyData;
                $count = $query
                    ->where('attribute_id', $attribute->id)
                    ->whereMonth('created_at', $monthNumber)
                    ->count();

                $numericalDataNumByAttribute[$attribute->name][$monthName] = $count;
            }
        }
        } else if ($selectedTableId === 'reservations-num' || $selectedTableId === 'cancellations-num'){
            foreach($attributes as $attribute) {
                foreach($months as $monthNumber => $monthName) {
                    $query = clone $yearlyData;
                    $count = $query
                        ->whereHas('area', function ($query) use ($attribute, $monthNumber) {
                            $query->where('attribute_id', $attribute->id);
                        })
                        ->whereMonth('date', $monthNumber)
                        ->count();
                    $numericalDataNumByAttribute[$attribute->name][$monthName] = $count;
                }
            }
        } else if ($selectedTableId === 'sales-num') {
            foreach($attributes as $attribute) {
                foreach($months as $monthNumber => $monthName) {
                    $query = clone $yearlyData;
                    $count = $query
                        ->whereHas('area', function ($query) use ($attribute, $monthNumber) {
                            $query->where('attribute_id', $attribute->id);
                        })
                        ->whereMonth('date', $monthNumber)
                        ->sum('fee_log');
                    $numericalDataNumByAttribute[$attribute->name][$monthName] = $count;
                }
            }
        } else {
            return response()->json(['error' => 'Invalid table ID']);
        }

        // Add "Total" attribute
        $numericalDataNumByAttribute['Total'] = [];
        foreach($months as $monthName) {
            $total = 0;
            foreach($attributes as $attribute) {
                $total += $numericalDataNumByAttribute[$attribute->name][$monthName];
            }
            $numericalDataNumByAttribute['Total'][$monthName] = $total;
        }

        // Convert the results array to an object
        $fetchedData = [
            'months' => array_values($months),
            'attributes' => array_merge($attributes->pluck('name')->toArray(), ['Total']),
            'numericalDataNumByAttribute' => $numericalDataNumByAttribute,
        ];
        return response()->json($fetchedData);
    }
}