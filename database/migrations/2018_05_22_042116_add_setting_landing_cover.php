<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Setting;

class AddSettingLandingCover extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $settings = [
            [
                'label'=>'cover_landing',
                'value'=>'rythm/images/landing/cover.jpg',
                'type'=>'upload'
            ]
        ];

        foreach ($settings as $setting) {
            $setting_m = new Setting;
            $setting_m->label = $setting['label'];
            $setting_m->value = $setting['value'];
            $setting_m->type = $setting['type'];
            $setting_m->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $setting = Setting::where('label','cover_landing');
        $setting->delete();
    }
}
