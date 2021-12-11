<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transactions extends Model
{
    use HasFactory;

    /**
     * Get the merchant that owns the transaction.
     */
    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }

    /**
     * Get the outlet that owns the transaction.
     */
    public function outlet()
    {
        return $this->belongsTo(Outlets::class, 'outlet_id');
    }

    public function omzetPerDay(String $my)
    {
        $result        = [];
        $merchant      = (new Merchant)->getMerchantFromUserid();
        $merchant_name = $merchant->merchant_name;
        $datas         = Transactions::where('merchant_id', $merchant->id)
            ->where('created_at', 'like', '%' . $my . '%')
            ->selectRaw("SUM(bill_total) as omzet, ".DB::raw("(DATE_FORMAT(created_at, '%d-%m-%Y')) as date"))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))
            ->get();
        
        // get days list
        $my   = explode('-', $my);
        $days = cal_days_in_month(CAL_GREGORIAN,$my[1],$my[0]);
        for ($i=1; $i <= $days; $i++) { 
            $day = $i < 10 ? "0$i" : $i;
            $date = date($day.'-'.$my[1].'-'.$my[0]);
            $result[$date] = 0;
        }

        foreach ($datas as $data) {
            $resultb[$data->date] = $data->omzet;
        }

        $results = array_replace_recursive($result, $resultb);

        foreach ($results as $key => $value) {
            $finalResult[] = [
                'date'  => $key,
                'omzet' => $value
            ];
        }

        return [
            'merchant_name' => $merchant_name,
            'omzet'         => $finalResult,
        ];
    }

    public function omzetPerDayOutlet(String $my)
    {
        $result        = [];
        $merchant      = (new Merchant)->getMerchantFromUserid();
        $merchant_name = $merchant->merchant_name;
        $datas         = Transactions::where('transactions.merchant_id', $merchant->id)
            ->where('transactions.created_at', 'like', '%' . $my . '%')
            ->leftJoin('outlets', 'outlets.id', '=', 'transactions.outlet_id')
            ->selectRaw("outlets.id as outlet_id, SUM(transactions.bill_total) as omzet, ".DB::raw("(DATE_FORMAT(transactions.created_at, '%d-%m-%Y')) as date"))
            ->groupBy(['outlets.id',DB::raw("DATE_FORMAT(transactions.created_at, '%d-%m-%Y')")])
            ->get();
        
        //get outlets list
        foreach ($datas as $data) {
            $outletsModel[$data->outlet_id] = $data->outlet->outlet_name;
        }

        // get days list
        $my   = explode('-', $my);
        $days = cal_days_in_month(CAL_GREGORIAN,$my[1],$my[0]);
        for ($i=1; $i <= $days; $i++) { 
            $day = $i < 10 ? "0$i" : $i;
            $date = date($day.'-'.$my[1].'-'.$my[0]);
            foreach ($outletsModel as $keyoutlet => $outlet) {
                $result[$date][$keyoutlet] = [
                    'outlet_name' => $outlet,
                    'omzet' => 0
                ];
            }
        }
        
        foreach ($datas as $data) {
            $resultb[$data->date][$data->outlet_id] = [
                'outlet_name' => $data->outlet->outlet_name,
                'omzet'       => $data->omzet
            ];
        }

        $results = array_replace_recursive($result, $resultb);
        
        foreach ($results as $key => $value) {
            $perOutlets[$key]['date'] = $key;
            foreach ($outletsModel as $keyoutlet => $outlet) {
                $perOutlets[$key]['outlets'][] = [
                    'outlet_name' => $outlet,
                    'omzet'       => $value[$keyoutlet]['omzet'],
                ];
            }
            $finalResult[] = $perOutlets[$key];
        }

        return [
            'merchant_name' => $merchant_name,
            'omzet'         => $finalResult,
        ];
    }
}
