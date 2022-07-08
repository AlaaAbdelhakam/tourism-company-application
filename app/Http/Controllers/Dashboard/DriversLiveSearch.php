<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
class DriversLiveSearch extends Controller
{
    

    function action(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = DB::table('drivers')
                       
                       
                        ->where('drivers.name', 'like', '%' . $query . '%')
                        ->orWhere('address', 'like', '%' . $query . '%')
                        ->orderBy('name', 'desc')
                        ->get();
            } else {
                $data = DB::table('users')
                       
                        ->where('drivers.name', 'like', '%' . '1' . '%')
                        ->orderBy('name', 'desc')
                        ->get();
            }
            $total_row = $data->count();

            if ($total_row > 0) {
                foreach ($data as $row) {
                    $inizio = Carbon::parse($row->inizio)->format('d.m.Y');
                    $output .= '
                    <tr>
                    <td>' . $row->name . '</td>
                    <td>' . $row->address . '</td>
                  
                    <td>' . $row->age . '</td>
                
                    </tr>
                    ';
                }
            } else {
                $output .= '
                <tr>
                <td align="center" colspan="5">
                Nessun utente trovato, importa i dati.
                </td>
                </tr>
                ';
            }
            $data = array(
                    'table_data' => $output
                );
            echo json_encode($data);
        }
    }

}