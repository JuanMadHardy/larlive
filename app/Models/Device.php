<?php

namespace App\Models;

use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Device extends Model
{
    use HasFactory;

    protected $fillable = ['name','ping','ip','schedule','email'];
}
