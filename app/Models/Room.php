<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $fillable = ['Customer_1_ID','Customer_2_ID','Room_Number'];

    protected $primaryKey = 'Room_ID';
}
