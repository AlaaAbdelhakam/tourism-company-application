<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Post;
class LiveSearch extends Controller
{
    function index()
    {
     return view('live_search');
    }

    function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = DB::table('posts')
       ->where('title', 'LIKE', "%{$query}%")
       ->orWhere('body', 'LIKE', "%{$query}%")
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
         <td>'.$row->title.'</td>
         <td>'.$row->description.'</td>
         <td>'.$row->body.'</td>
         <td>             <a class="btn btn-info btn-sm" href="posts/'.$row->id.'/show" > Show </a>

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
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }
}

