<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class providers extends Model
{
    use HasFactory;

    protected $table = 'providers';

    protected $fillable = ["name", "nif", "chiefNif", "averageDeliveryTime", "productToSupply", "localization", "observations"];

    protected $dates = ["deleted_at"];

    function providers()
    {
        return $this->belongsTo('App\Providers');
    }
}
