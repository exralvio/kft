<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\SisterCompany;

class InitSisterCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sister_companies = [
            'TELKOMSEL',
            'MITRATEL',
            'PINS',
            'TELKOMMETRA',
            'TELKOM AKSES',
            'TELIN',
            'TELKOM INFRA',
            'TELKOM PROPERTY',
            'PATRAKOM',
            'PT. JALIN PEMBAYARAN NUSANTARA',
            'METRANET',
            'INFOMEDIA'
        ];

        foreach ($sister_companies as $sister) {
            $sister_company = new SisterCompany;
            $sister_company->name = $sister;
            $sister_company->save();
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::collection('sister_companies')->raw(function($collection){
            $collection->drop();
        });
    }
}
