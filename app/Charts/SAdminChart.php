<?php

declare(strict_types=1);

namespace App\Charts;

use App\Models\faculty;
use App\Models\Person;
use App\Models\verifiedData;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class SAdminChart extends BaseChart
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
        //chart1
        $people = Person::select('faculty_id')->orderBy('faculty_id', 'asc')->get()->countBy('faculty_id')->values()->toArray();
        $verifiedpeople = verifiedData::select('faculty_id')->orderBy('faculty_id', 'asc')->get()->countBy('faculty_id')->values()->toArray();
        $faculties = faculty::select('facultyCode')->get()->pluck('facultyCode')->toArray();

        return Chartisan::build()
            ->labels($faculties)
            ->dataset('unverified', $people)
            ->dataset('verified', $verifiedpeople);

        // return Chartisan::build()
        //     ->labels(['First', 'Second', 'Third'])
        //     ->dataset('Sample', [1, 2, 3])
        //     ->dataset('Sample 2', [3, 2, 1]);
    }
}
