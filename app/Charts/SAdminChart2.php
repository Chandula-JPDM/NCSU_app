<?php

declare(strict_types=1);

namespace App\Charts;

use App\Models\faculty;
use App\Models\Person;
use App\Models\verifiedData;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class SAdminChart2 extends BaseChart
{
    /**
     * Determines the chart name to be used on the
     * route. If null, the name will be a snake_case
     * version of the class name.
     */
    // public ?string $name = 'custom_chart_name';

    /**
     * Determines the name suffix of the chart route.
     * This will also be used to get the chart URL
     * from the blade directrive. If null, the chart
     * name will be used.
     */
    // public ?string $routeName = 'chart_route_name';

    /**
     * Determines the middlewares that will be applied
     * to the chart endpoint.
     */
    //public ?array $middlewares = ['auth', 'admin'];

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        //#####chart2 requests to be verified day by day
        $noEntriesUnverified = Person::select(\DB::raw('DATE(`created_at`)'))->orderBy('created_at', 'asc')->get()->countBy('DATE(`created_at`)')->values()->toArray();
        $dates1 = Person::select(\DB::raw('DATE(`created_at`)'))->groupBy('DATE(`created_at`)')->orderBy('DATE(`created_at`)', 'asc')->get()->pluck('DATE(`created_at`)')->toArray();
        $noEntriesVerified = verifiedData::select(\DB::raw('DATE(`created_at`)'))->orderBy('DATE(`created_at`)', 'asc')->get()->countBy('DATE(`created_at`)')->values()->toArray();
        $dates2 = verifiedData::select(\DB::raw('DATE(`created_at`)'))->groupBy('DATE(`created_at`)')->orderBy('DATE(`created_at`)', 'asc')->get()->pluck('DATE(`created_at`)')->toArray();

        return Chartisan::build()
            ->labels($dates1, $dates2)
            ->dataset('unverified Entries', $noEntriesUnverified)
            ->dataset('verified Entries', $noEntriesVerified);

        // return Chartisan::build()
        //     ->labels(['First', 'Second', 'Third'])
        //     ->dataset('Sample', [1, 2, 3])
        //     ->dataset('Sample 2', [3, 2, 1]);
    }
}
