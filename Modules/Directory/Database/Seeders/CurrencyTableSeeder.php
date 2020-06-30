<?php

namespace Modules\Directory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Directory\Repositories\CurrencyRepository;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = CurrencyRepository::getDataSite();
        foreach ($currencies as $currency) {
            DB::table('spr_currencies')->insert([
                'country_id' => $currency.country_id,
                'name' => $currency.name,
                'emission_center' => $currency . emission_center,
                'symbol' => $currency . symbol,
                'sample_url' => $currency . sample_url,
                'iso_name' => $currency . iso_name,
                'iso_code' => $currency . iso_code,
                'iso_code_name' => $currency . iso_code_name,
                'currency_unit' => $currency . currency_unit,
                'currency_unit_sample_url' => $currency . currency_unit_sample_url,
                'descr' => $currency . descr,
            ]);
        }

        // $this->call("OthersTableSeeder");
    }
}
