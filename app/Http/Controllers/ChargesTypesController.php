<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChargesType;
use Validator;
use Auth;

class ChargesTypesController extends Controller
{
    public function index()
    {
        if(!Auth::user()->hasPermissionTo('charges-types-view'))
        {
            return abort(401);
        
        }
        $chargesType = ChargesType::all();
        return view('charges-types.index',compact('chargesType'));
    }
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('charges-types-create'))
        {
            return abort(401);
        }
        $chargesType = ChargesType::all();
        return view('charges-types.create',compact('chargesType'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:200|unique:charges_types,name',
            'amount' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status'=>false, 'error'=>$validator->errors()->all()]);
        }
        $inputs = [
            'name' => $request->name,
            'amount' => $request->amount,
            'is_active' => $request->has('is_active')?1:0,
        ];
        ChargesType::create($inputs);
        return response()->json(['status'=>true, 'success'=>"Charges Type added successfully."]);
    }

    public function edit($id)
    {
        if(!Auth::user()->hasPermissionTo('charges-types-edit'))
        {
            return abort(401);
        }
        $chargesType = ChargesType::findOrFail($id);
        return View('charges-types.edit',compact('chargesType'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:200|unique:charges_types,name,'.$request->id
        ]);

        $chargesType = ChargesType::findOrFail($request->id);
        $chargesType->name = $request->name;
        $chargesType->amount = $request->amount;
        $chargesType->is_active = $request->has('is_active')?1:0;
        $chargesType->save();
        return response()->json(['status'=>true, 'success'=>"Charges Type updated successfully."]);
    }

    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('charges-types-delete'))
        {
            return abort(401);
        }
        $Charges_type = ChargesType::findOrFail($id);
        $Charges_type->delete();
        return redirect()->route('charges-types.index')->with('success','Charges Type deleted successfully.');
    }

}
