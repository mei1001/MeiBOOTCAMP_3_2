<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	

public function bookUnit(Request $request) 
{
DB::beginTransaction();
try 
{
$this->validate($request, [
'Room_id' => 'required',
'DataCustomer_id' => 'required',
'check_in' => 'required',
'check_out' => 'required'
]);
$roomID = $request->input('Room_id');
$DataCustomerID = $request->input('DataCustomer_id');
$checkin = $request->input('check_in');
$checkout = $request->input('check_out');
DB::table('transaction')->insert([
['Room_id' => $RoomID, 'DataCustomer_id' => $DataCustomerID,
'checkin' => $checkin, 'checkout' => $checkout]
]);
$rent = DB::table('transaction')->select(transaction.rent_id, transaction.DataCustomer_id, transaction.Room_id, 
transaction.checkin, transaction.checkout, Room.status)->get();
DB::commit();
return response()->json($rent, 200);
}
catch(\Exception $e) 
{
DB::rollBack();
return response()->json(["message" => $e->getMessage()], 500);
} 
}

}


