<?php

namespace App\Http\Controllers;

use App\Models\Agents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class EntryController extends Controller
{
    public function medicalEntry(Request $request){

        if(Session::get('user')){
            if($request->isMethod('GET')){
               
                $candidates = DB::table('candidates')
                ->leftJoin('visas', 'candidates.id', '=', 'visas.candidate_id')
                ->select('candidates.*', 'visas.*')
                ->where('candidates.agency', '=', Session::get('user'))
                ->get();
     // dd($candidates);
            $user = DB::table('user')->select('*')->where('email', '=', Session::get('user'))->first();
    
            return view('entries.medical', compact('candidates', 'user'));
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
    public function IssuedVisaEntry(Request $request){

        if(Session::get('user')){
            if($request->isMethod('GET')){
               
                $candidates = DB::table('candidates')
                ->leftJoin('visas', 'candidates.id', '=', 'visas.candidate_id')
                ->select('candidates.*', 'visas.*')
                ->where('candidates.agency', '=', Session::get('user'))
                ->get();
     // dd($candidates);
            $user = DB::table('user')->select('*')->where('email', '=', Session::get('user'))->first();
    
            return view('entries.issued_visa', compact('candidates', 'user'));
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
    public function MofaEntry(Request $request){

        if(Session::get('user')){
            if($request->isMethod('GET')){
               
                $candidates = DB::table('candidates')
                ->leftJoin('visas', 'candidates.id', '=', 'visas.candidate_id')
                ->select('candidates.*', 'visas.*')
                ->where('candidates.agency', '=', Session::get('user'))
                ->get();
     // dd($candidates);
            $user = DB::table('user')->select('*')->where('email', '=', Session::get('user'))->first();
    
            return view('entries.mofa_entry', compact('candidates', 'user'));
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
    public function BiometricEntry(Request $request){

        if(Session::get('user')){
            if($request->isMethod('GET')){
               
                $candidates = DB::table('candidates')
                ->leftJoin('visas', 'candidates.id', '=', 'visas.candidate_id')
                ->select('candidates.*', 'visas.*')
                ->where('candidates.agency', '=', Session::get('user'))
                ->get();
     // dd($candidates);
            $user = DB::table('user')->select('*')->where('email', '=', Session::get('user'))->first();
    
            return view('entries.biometric', compact('candidates', 'user'));
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
    public function ManpowerEntry(Request $request){

        if(Session::get('user')){
            if($request->isMethod('GET')){
               
                $candidates = DB::table('candidates')
                ->leftJoin('visas', 'candidates.id', '=', 'visas.candidate_id')
                ->select('candidates.*', 'visas.*')
                ->where('candidates.agency', '=', Session::get('user'))
                ->get();
     // dd($candidates);
            $user = DB::table('user')->select('*')->where('email', '=', Session::get('user'))->first();
    
            return view('entries.manpower_entry', compact('candidates', 'user'));
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
    public function TrainingFingerEntry(Request $request){

        if(Session::get('user')){
            if($request->isMethod('GET')){
               
                $candidates = DB::table('candidates')
                ->leftJoin('visas', 'candidates.id', '=', 'visas.candidate_id')
                ->select('candidates.*', 'visas.*')
                ->where('candidates.agency', '=', Session::get('user'))
                ->get();
     // dd($candidates);
            $user = DB::table('user')->select('*')->where('email', '=', Session::get('user'))->first();
    
            return view('entries.training_finger', compact('candidates', 'user'));
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
    public function FlightEntry(Request $request){

        if(Session::get('user')){
            if($request->isMethod('GET')){
               
                $candidates = DB::table('candidates')
                ->leftJoin('visas', 'candidates.id', '=', 'visas.candidate_id')
                ->select('candidates.*', 'visas.*')
                ->where('candidates.agency', '=', Session::get('user'))
                ->get();
     // dd($candidates);
            $user = DB::table('user')->select('*')->where('email', '=', Session::get('user'))->first();
    
            return view('entries.flight_entry', compact('candidates', 'user'));
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
    public function DeliveryEntry(Request $request){

        if(Session::get('user')){
            if($request->isMethod('GET')){
               
                $candidates = DB::table('candidates')
                ->leftJoin('visas', 'candidates.id', '=', 'visas.candidate_id')
                ->select('candidates.*', 'visas.*')
                ->where('candidates.agency', '=', Session::get('user'))
                ->get();
     // dd($candidates);
            $user = DB::table('user')->select('*')->where('email', '=', Session::get('user'))->first();
    
            return view('entries.delivery', compact('candidates', 'user'));
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
