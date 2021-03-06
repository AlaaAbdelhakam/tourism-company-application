<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use DB;
use App\Models\Driver;
class DriverLiveSearch extends Controller
{
    function index()
    {
     return view('dashboard.drivers.live_search');
    }

    function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = DB::table('drivers')
       ->where('name', 'LIKE', "%{$query}%")
       ->orWhere('age', 'LIKE', "%{$query}%")
         ->get();
         
      }
      else
      {
      //  $data = DB::table('tbl_customer')
      //    ->orderBy('CustomerID', 'desc')
      //    ->get();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
        $output .= '
        <tr>
         <td>'.$row->id.'</td>
         <td>'.$row->name.'</td>
         <td>'.$row->age.'</td>
         <td>'.$row->address.'</td>
        

         </td>
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
      
      );

      echo json_encode($data);
     }
    }
}