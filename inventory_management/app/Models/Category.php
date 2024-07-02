<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Receiver;

use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];

    
}
