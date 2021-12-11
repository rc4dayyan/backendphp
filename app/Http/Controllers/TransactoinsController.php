<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Transactions;
use App\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class TransactoinsController extends Controller
{

    public function monthlyOmzet(Request $request)
    {
        $year_month = $request->query('my') ?? '2021-11';
        $data = (new Transactions)->omzetPerDay($year_month);

        // convert array to collection with pagination
        $per_page = 30;
        $results = (new Collection($data['omzet']))->paginate($per_page);

        return response()->json([
            'merchant_name' => $data['merchant_name'],
            'omzets' => $results
        ], 200);
    }

    public function monthlyOmzetOutlet(Request $request)
    {
        $year_month = $request->query('my') ?? '2021-11';
        $data = (new Transactions)->omzetPerDayOutlet($year_month);

        // convert array to collection with pagination
        $per_page = 30;
        $results = (new Collection($data['omzet']))->paginate($per_page);

        return response()->json([
            'merchant_name' => $data['merchant_name'],
            'omzets' => $results
        ], 200);
    }
}
