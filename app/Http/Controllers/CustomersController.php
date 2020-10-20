<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Exports\CustomersExport;
use App\Exports\ListCustomersExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Customer::orderBy('Customer_ID', 'ASC')->get();
    }
    public function checkPhone(Request $request)
    {
        return DB::table('customers')
                    ->where('Phone',$request->Phone)
	                ->count();
    }
    public function countAllCustomer(Request $request)
    {
        return DB::table('customers')->count();
    }
    public function countCustomerMatch(Request $request)
    {
        return DB::table('customers')
                    ->where('Status','=',0)
                    ->count();
    }
    public function countCustomerNotMatch(Request $request)
    {
        return DB::table('customers')
                    ->where('Status','=',1)
                    ->count();
    }
    public function tracking(Request $request)
    {
        return DB::table('customers')
                    ->join('hotels','hotels.Customer_ID','=','customers.Customer_ID')
                    ->leftjoin('rooms','rooms.Room_ID','=','hotels.Room_ID')
                    ->select('Prefix','F_Name','L_Name','Gender','Rank','Email','Phone','Province','Food_Group','Food_Allergy','Check_In','Check_Out','Partner_ID','Room_Number')
                    ->where('Phone',$request->Phone)
                    ->get();
    }
    public function matching()
    {
        return DB::table('customers')
                    ->where('Status','=',1)
                    ->select('Customer_ID','Prefix','F_Name','L_Name','Gender','Rank','Email','Phone','Province','Food_Group','Food_Allergy','Status')
                    ->orderBy('Customer_ID', 'ASC')
                    ->get();
    }
    public function customersHotel()
    {
        return DB::table('customers')
                    ->leftjoin('hotels as h','customers.Customer_ID','=','h.Customer_ID')
                    ->select('h.Hotel_ID','customers.Prefix','customers.Customer_ID','customers.F_Name as F_1','customers.L_Name as L_1','customers.Province','h.Check_In','h.Check_Out','h.Room_ID','Note')
                    ->orderBy('h.Hotel_ID', 'ASC')
                    ->get();
    }
    public function customersRoom()
    {
        return DB::table('rooms')
                    ->leftjoin('customers as u1','u1.Customer_ID','=','rooms.Customer_1_ID')
                    ->leftjoin('customers as u2','u2.Customer_ID','=','rooms.Customer_2_ID')
                    ->select('rooms.Room_ID','u1.Customer_ID as UID1','u1.Prefix as PF_1','u1.F_Name as F_1','u1.L_Name as L_1','u1.Province as PV_1','u2.Customer_ID as UID2','u2.Prefix as PF_2','u2.F_Name as F_2','u2.L_Name as L_2','u2.Province as PV_2','rooms.Room_Number')
                    ->orderBy('Room_ID', 'ASC')
                    ->get();
    }
    public function provinceCustomerRoom1(Request $request){
        return Customer::where('Province',$request->Province_1)->get();
    }
    public function provinceCustomerRoom2(Request $request){
        return Customer::where('Province',$request->Province_2)->get();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Prefix' => 'required',
            'F_Name' => 'required',
            'L_Name' => 'required',
            'Gender' => 'required',
            'Rank' => 'required',
            'Email' => 'required',
            'Phone' => 'required',
            'Province' => 'required',
            'Food_Group' => 'required',
            'Status' => 'required',
        ]);
        $customer = Customer::create($request->all());
        return $customer;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Customer::find($id);
    }

    public function exportCustomer()
    {
        return Excel::download(new CustomersExport, 'customers.xlsx');
        "Export succesfuly";
    }
    public function exportListCustomer()
    {
        return Excel::download(new ListCustomersExport, 'listCustomers.xlsx');
        "Export succesfuly";
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->update($request->all());
        return $customer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->destroy($id);
        return 'delete successfuly';
    }
}
