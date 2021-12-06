<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DomainName;

class ShortLink extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'link','domain_id'
    ];

    public function domain()
    {
        return $this->belongsTo(DomainName::class,'domain_id','id');
    }
}
