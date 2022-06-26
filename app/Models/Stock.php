<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    use HasFactory;

    protected $table = 'stocks';

    protected $fillable = ["productId", "quantityProvider", "quantityRecommended", "state", "observations"];

    protected $dates = ["deleted_at"];

    public function providers()
    {
        return $this->hasMany('App\Products');
    }
}
