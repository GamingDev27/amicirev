<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
	
	const TYPE_ABOUT = 2;
	const TYPE_MEMBER = 3;
	const TYPE_CONTACT = 4;
	
}
