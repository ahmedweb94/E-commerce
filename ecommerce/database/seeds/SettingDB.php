<?php

use Illuminate\Database\Seeder;
use App\Model\Setting;
class SettingDB extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $add = new Setting;
      $add->sitename_ar = 'اسم الموقع';
      $add->sitename_en = 'Site Name';
      $add->logo = '';
      $add->icon = '';
      $add->email = 'Site Email';
      $add->main_lang = 'ar';
      $add->description = 'Site Description';
      $add->keywords = 'Site Keyword';
      $add->message_maintenance = 'maintenance Message';
      $add->status = 'open';
      $add->save();
    }
}
