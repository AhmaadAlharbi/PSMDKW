<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Task extends Model
{
    use Notifiable;

    use HasFactory;
    protected $guarded = [];
    public function station()
    {
        return $this->belongsTo(Stations::class,'station_id');
    }
    public function engineers()
    {
        return $this->belongsTo(engineer::class,'eng_id');
    }
}