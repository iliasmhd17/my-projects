<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MedicalCard;
use App\Models\Testing;
use App\Forms\RecordForm;
use App\Models\Children;
use App\Models\Group;
use App\Models\Parental_Link;
use Illuminate\Support\Facades\Validator;

class MedicalController extends Controller
{

    public function getDbRecords()
    {
        $user = Auth::user();
        $userEmail = $user->email;
        $data = [];
        // Retrieve records from the medical_cards table where the email matches
        if($user->role == 'Animator')
        {
            $data = MedicalCard::getAllMedicalCards();
        }else{
            $data = MedicalCard::getUserEmail($userEmail);
        }
        $nbFiches = $data->count();

        // $data = DB::table('medical_card')->where('email', $userEmail)->get();
        return view('medicalCards', compact('data', 'nbFiches'));
    }

    public function getCardDetails($id)
    {

        $data = DB::table('medical_card')
            ->where('national_number', $id)
            ->get();

        $children = DB::table('medical_card')
            ->where('national_number', $id)
            ->get();

        $parent_infos = DB::table('parental_link')
            ->join('medical_card', 'parental_link.national_number', '=', 'medical_card.national_number')
            ->get();
        $fields = RecordForm::getFormFields();

        $groups = Group::allGroups();
        return view('medicalCardsDetails', compact('data', 'children', 'parent_infos', 'fields','groups'));
    }

    public function createRecord(Request $request)
    {
        $validator = Validator::make($request->all(), RecordForm::rules());
    
        // Check if the validation fails
        if ($validator->fails()) {
            // Redirect back with validation errors
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            MedicalCard::createMedicalCard($request->all());
        } catch (\Exception $e) {
            // Gestion de l'exception si le numéro national existe déjà
            return redirect()->back()->withErrors(['national_number' => $e->getMessage()])->withInput();
        }    
        // If validation passes, proceed with your logic
        $data = $request->all();
    
        // Emergency contact of parent and doctor
        $data['emergency_contact_parent'] = $request->input('emergency_contact_parent');
        // $data['emergency_contact_doctor'] = $request->input('emergency_contact_doctor');
    
        // MedicalCard::createMedicalCard($data);
    
        $child_data = [
            'national_number' => $data['national_number'],
            'parent_1' => Auth::user()->email,
        ];
    
        Parental_Link::createChild($child_data);
    
        return redirect('fiches');
    }    

    public function deleteRecord(Request $request)
    {
        $data = $request->all();
        MedicalCard::deleteMedicalCard($data['national_number']);
        return redirect('fiches');
    }

    public function getRecordEditPage($id)
    {
        $data = MedicalCard::getMedicalCardById($id);
    }

    public function editRecord(Request $request)
    {
        $validator = Validator::make($request->all(), RecordForm::rules());

        // Check if the validation fails
        if ($validator->fails()) {

            // Redirect back with validation errors
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // If validation passes, proceed with your logic
        $data = $request->all();
        MedicalCard::updateMedicalCard($data['national_number'], $data);
        return redirect('fiches/details/' . $data['national_number']);
    }

    public function addGroup(Request $request){
    $originalName = $request->input('originalName');
    $newName = $request->input('newName');

    Parental_Link::updateGroupName($originalName, $newName);

    return redirect('fiches/details/' . $request->input('national_number'));
    }

}
