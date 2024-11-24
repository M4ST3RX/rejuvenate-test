<?php

namespace App\Models;

use App\Searchable;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use Searchable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'country_id',
        'active'
    ];

    public function country() {
        return $this->belongsTo(Country::class);
    }
}
