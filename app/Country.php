<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries_names';
    use HasFactory;

    public function team()
    {
        return $this->hasOne(Team::class, 'country_id', 'name');
    }
}
