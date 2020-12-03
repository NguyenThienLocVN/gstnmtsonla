<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Licenses extends Model
{
    public $table = 'licenses';

    public function relationsDistrict() {
        return $this->hasOne('App\Models\Cities', 'code', 'district_code');
    }

    public function relationsCommune() {
        return $this->hasOne('App\Models\Cities', 'code', 'commune_code');
    }

}
