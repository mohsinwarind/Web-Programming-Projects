<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
        'contact_id',
        'admin_id',
        'message',
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
