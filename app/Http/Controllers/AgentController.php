<?php

namespace App\Http\Controllers;

use App\Models\Agents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class AgentController extends Controller
{
    public function agent_add(Request $request){

        if(Session::get('user')){
            if($request->isMethod('GET')){
               
                
                $query = DB::table('candidates')
                ->leftJoin('visas', 'candidates.id', '=', 'visas.candidate_id')
                ->select('candidates.*', 'visas.visa_no', 'visas.mofa_no', 'visas.spon_id')
                ->where('candidates.agency', '=', Session::get('user'));
    
            // Add search functionality
            if ($request->has('search')) {
                $searchTerm = $request->input('search');
                $query->where(function ($query) use ($searchTerm) {
                    $query->where('candidates.name', 'like', '%' . $searchTerm . '%')
                          ->orWhere('candidates.id', 'like', '%' . $searchTerm . '%')
                          ->orWhere('candidates.passport_number', 'like', '%' . $searchTerm . '%');
                });
            }
    
            $query->orderBy('candidates.created_at', 'desc');
    
            $candidates = $query->paginate(10);
            $user = DB::table('user')->select('*')->where('email', '=', Session::get('user'))->first();
    
            return view('user.index', compact('candidates', 'user'));
            }
        
            else {
                DB::beginTransaction();
                $response = [
                    'redirect_url' => 'user/index',
                ];
            
                try {
                    $agent = new Agents();
        
                    $agent->agent_name = strtoupper($request->input('agent_name'));
                    $agent->agent_phone = strtoupper($request->input('agent_phone'));
                    $agent->agent_email = $request->input('agent_email');
                    $agent->agent_address = strtoupper($request->input('agent_address'));
                    $agent->agent_e_phone = strtoupper($request->input('agent_e_phone'));
                    if ($request->hasFile('agent_picture')) {
                        $logo = $request->file('agent_picture');
                        $filename = time() . '_' . $logo->getClientOriginalName();
                        $logo->move(public_path('agent_picture'), $filename);
                        $agent->agent_picture = 'agent_picture/' . $filename;
                    }
                    dd($request->all(), $agent);
                    // Save the candidate
                    if ($agent->save()) {
                        DB::commit();
                        $response['title'] = 'Success';
                        $response['success'] = true;
                        $response['icon'] = 'success';
                        $response['message'] = 'Successfully created';
                    } else {
                        $response['title'] = 'Error';
                        $response['success'] = false;
                        $response['icon'] = 'error';
                        $response['message'] = 'Cannot add Agent';
                    }
                } catch (\Exception $e) {
                    DB::rollback();
                    $response['title'] = 'Error';
                    $response['success'] = false;
                    $response['icon'] = 'error';
                    $response['message'] = $e->getMessage(); // Get the actual error message
                }
            
                return response()->json($response);
            }
            
        }
        else{
            // return view('welcome');
            return redirect(url('/'));
        }
           
       }
}
