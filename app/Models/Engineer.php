<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Engineer extends Model
{
    use HasFactory;
    protected $guarded = [];
    use Notifiable;

     
    public function area()
    {
        return $this->belongsTo(Areas::class);
    }
    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
}