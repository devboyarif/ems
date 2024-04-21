<?php

namespace App\Models;

use App\Models\Email;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function emails()
    {
        return $this->hasMany(Email::class);
    }
}
