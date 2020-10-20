<?php

namespace App\Exports;
use DB;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('hotels')
                ->leftjoin('customers as u1','u1.Customer_ID','=','hotels.Customer_ID')
                ->leftjoin('customers as u2','u2.Customer_ID','=','hotels.Partner_ID')
                ->leftjoin('rooms as r','r.Room_ID','=','hotels.Room_ID')
                ->select('u1.Customer_ID as ID','u1.Prefix as PF1','u1.F_Name as F1','u1.L_Name as L1','u1.Gender as G1','u1.Email as E1','u1.Phone as P1','u1.Province as PV1','u1.Food_Group as FG1','u1.Food_Allergy as FA1','u2.Prefix as PF2','u2.F_Name as F2','u2.L_Name as L2','u2.Gender as G2','u2.Province as PV2','u2.Phone as P2','r.Room_Number','Note')
                ->orderBy('u1.Customer_ID','ASC')
                ->get();
    }
    public function headings(): array {
        return [
            'id',
            'คำนำหน้า',
            'ชื่อจริง',
            'นามสกุุล',
            'เพศ',
            'อีเมล',
            'โทรศัพท์',
            'จังหวัด',
            'ประเภทอาหาร',
            'อาหารที่แพ้',
            'คำนำหน้า',
            'ชื่อคู่พัก',
            'นามสกุลคู่พัก',
            'เพศ',
            'จังหวัดคู่พัก',
            'โทรศัพท์คู่พัก',
            'หมายเลขห้อง',
            'หมายเหตุ'
        ];
    }
}
