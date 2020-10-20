<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $table = 'hotels';
    protected $fillable = ['Customer_ID','Check_In','Check_Out','Room_ID','Note','Partner_ID'];

    protected $primaryKey = 'Hotel_ID';
}
