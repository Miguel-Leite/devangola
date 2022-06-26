<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ["name", "cod", "batch", "providerId, price"];

    protected $dates = ["deleted_at"];

    public function providers()
    {
        return $this->hasMany('App\Providers');
    }
}
