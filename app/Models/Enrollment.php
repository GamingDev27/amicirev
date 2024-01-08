<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
class Enrollment extends Model
{
    use HasFactory;

    const PAYMENT_NEW = 0;
    const PAYMENT_COMPLETE = 1;
    const PAYMENT_PARTIAL = 2;
    const PAYMENT_PENDING = 3;
    const PAYMENT_REJECTED = 4;
    const PAYMENT_STATUSES = ["NEW","FULLYPAID","PARTIAL","PENDING","REJECTED"];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
