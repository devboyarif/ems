<?php

namespace App\Models;

use App\Models\EmailGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Email extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function groups()
    {
        return $this->belongsTo(EmailGroup::class);
    }
}
