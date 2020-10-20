<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $fillable = [
                            'Prefix',
                            'F_Name',
                            'L_Name',
                            'Gender',
                            'Rank',
                            'Email',
                            'Phone',
                            'Province',
                            'Food_Group',
                            'Food_Allergy',
                            'Status'
                        ];
    protected $primaryKey = 'Customer_ID';
}
