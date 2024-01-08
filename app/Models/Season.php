<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Batch;


class Season extends Model
{
    use HasFactory;

    public function batches()
    {
        return $this->hasMany(Batch::class);
    }
}
