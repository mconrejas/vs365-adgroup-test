<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Comment extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip_id', 'user_id', 'comment'
    ];

    public function ip()
    {
        return $this->belongsTo(IP::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
