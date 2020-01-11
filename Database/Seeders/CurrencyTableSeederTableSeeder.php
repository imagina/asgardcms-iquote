<?php

namespace Modules\Iquote\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Modules\Iquote\Entities\Currency;


class CurrencyTableSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();


        Currency::create([
            'code' => 'AUD',
            'symbol_left' => '$',
            'symbol_right' => '',
            'decimal_place' => '',
            'value' => 1,
            'status' => 1,
            "default_currency"	=> true
        ]);

        Currency::create([
            "code"	=> "COP",
            "symbol_left"	=> "$",
            "symbol_right"	=> "",
            "decimal_place"=> "",
            "value"	=> 0.000443,
            "status"	=> 1,
            "default_currency"	=> false
        ]);

    }
}
