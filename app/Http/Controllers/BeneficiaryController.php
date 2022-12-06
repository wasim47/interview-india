<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beneficiary;

class BeneficiaryController extends Controller
{
    public function form(){
		$data = Beneficiary::paginate(50);
		return view('form',compact('data'));
	}
	
	 public function formSubmit(Request $request){
	 	$validator = $request->validate([
			'account_id' => 'required|numeric|unique:beneficiaries|max:255',
			'introducer_id' => 'required|numeric',
		]);
			
	 	try{		
			$currentIntroducer = $request['introducer_id'];
			
			$checkExist = Beneficiary::where('introducer_id',$currentIntroducer);
			if($checkExist->count() > 0){
				$totalIntroducer = $checkExist->count();
				if($totalIntroducer%2 != 0){
					$introducer = Beneficiary::where('account_id',$currentIntroducer)->first();
					if($introducer!=""){
						$introducerId = $introducer->introducer_id;
						$beneficiary = Beneficiary::where('account_id',$introducerId)->first();
						$beneficiary_id = $beneficiary->beneficiary_id;
					}
					else{
						$beneficiary_id = 0;
					}
				}
				else{
					$bData = $checkExist->first();
					$beneficiary_id = $bData->introducer_id;
				}
			}
			else{
				$beneficiary_id = $currentIntroducer;
			}
			
			
			
			$request['beneficiary_id'] = $beneficiary_id;
			$data = $request->except('_token','submit');
			Beneficiary::insert($data);
			return redirect()->back()->with('success','Successfully Inserted');
		}
		catch(Exception $e){
			return redirect()->back()->with('error',$e);
		}
	}
}
