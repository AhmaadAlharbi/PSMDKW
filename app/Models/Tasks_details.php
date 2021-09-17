<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Tasks_details extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function engineers()
    {
        return $this->belongsTo(engineer::class,'eng_id');
    }
    public function station()
    {
        return $this->belongsTo(Stations::class,'station_id');
    }
}