<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainName extends Model
{
    use HasFactory;
    protected $table='domain';
    protected $fillable = [
        'domain_name',
    ];

    public function domain()
    {
        return $this->belongTo(App\Models\ShortLink::class,'id','domain_id');
    }
}
