<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\SettingDetail;
use App\Models\Location;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Storage;
use Image;
use Auth;
use Artisan;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = SettingDetail::join('settings', 'settings.id', '=', 'setting_details.setting_id')->get(['settings.slug','setting_details.key','setting_details.value'])->toArray();
        $settingGroup = array_unique(array_column($settings,'slug'));
        $settingsData = [];
        foreach($settings as $value){
            
            foreach($settingGroup as $child){
                if($child == $value['slug'])
                {
                    $settingsData[ $value['slug']][ $value['key']]= $value['value'];
                }
            }
        }

        // Fetch locations
        $locations = Location::all();
        $template = Template::all();
        return view('settings.index',compact('settingsData', 'locations','template'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'representative_name' => 'required',
            'representative_signature_image' => 'required_without:signature_status|mimes:jpeg,jpg,png|nullable|max:2048',
            'signature' => 'required_with:signature_status'
        ]);

        $slug = $request->slug;
        $settings = Setting::where('slug',$slug)->firstOrFail();
        $settingDetails = SettingDetail::where('setting_id',$settings->id)->get();
        if($slug == "representative information"){
            $settingDetails->each(function($item) use ($request){
                if($item->key == 'representative_signature_image'){
                    if($request->has('signature_status')){
                        $file_name = 'signatures/'. uniqid().''.uniqid().'.png';
                        $file_stream = Image::make(file_get_contents($request->signature))->stream();
                        Storage::disk('local')->put($file_name,$file_stream);
                    }
                    else{
                        $file_name = $request->representative_signature_image->store('signatures');
                    }
                    $item->value = $file_name;
                    $item->saveQuietly();

                }
                else if($item->key == 'representative_name'){
                    $name = $request->representative_name;
                    $item->value = $name;
                }
                $item->save();
            });
        }

        return redirect()->back()->with('success','Representative Signature added successfully');
    }

    public function update(Request $request)
    {
        $slug = $request->slug;
        $settings = Setting::where('slug',$slug)->firstOrFail();
        $settingDetails = SettingDetail::where('setting_id',$settings->id)->get();
        // dd($settingDetails);
        if($slug == 'tax'){
            $settingDetails->each(function($item) use ($request){
                if($item->key == 'qst_tax'){
                    $item->value = $request->qst_tax;
                }
                else if($item->key == 'gst_tax'){
                    $item->value = $request->gst_tax;
                }
                $item->save();
            });
        }
        if($slug == 'smtp'){
            $settingDetails->each(function($item) use ($request){
                if($item->key == 'MAIL_HOST'){
                    $item->value = $request->smtp_host;
                }
                else if($item->key == 'MAIL_PORT'){
                    $item->value = $request->port;
                }
                else if($item->key == 'MAIL_USERNAME'){
                    $item->value = $request->email;
                    // env("MAIL_USERNAME")->update($item->value);
                }
                else if($item->key == 'MAIL_PASSWORD'){
                    $item->value = $request->email_password;
                }
                $item->save();
            });
            $this->SetMailSettingInEnv($settingDetails);
        }
        return redirect()->route('settings')->with('success','Settings updated successfully');
    }

    public function SetMailSettingInEnv($attributes)
    {
        $path = base_path('.env');
        $i = 0;
        if (file_exists($path)) 
        {
            $temp_file_content = file_get_contents($path);
            
            foreach ($attributes as $key => $value) 
            {
                // dd($attributes, $value->key, $value->value);
                if (str_contains($temp_file_content,$value->key)) 
                {
                    // dd($temp_file_content);
                    $env = (env($value->key)!=null)? env($value->key):"null";
                    // dd($env,env($value->key));
                    file_put_contents($path, str_replace(
                        $value->key.'='.$env,
                        $value->key.'='.$value->value,
                        file_get_contents($path)
                    ));
                } 
                else {
                    if($i==0)
                    { 
                        file_put_contents($path,"\n",FILE_APPEND); 
                        $i++;
                    }
                    file_put_contents($path,$value->key.'='.$value->value."\n",FILE_APPEND);
                }      
            }
        }
    }

    public function changePassword(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'old_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|required_with:old_password|confirmed|min:6',
        ]);
        if ($validator->passes()) {
            $user_data = [];
            if($request->has('new_password') && $request->new_password != ''){
                if(!Hash::check($request->old_password, Auth::user()->password)){
                    $validator->getMessageBag()->add('password', 'Old Password doesn\'t matched');
                    return response()->json(['status'=>false,'error'=>$validator->errors()->all()]);
                }
                $user_data['password'] = Hash::make($request->new_password);
            }   
            Auth::user()->update($user_data);
            return redirect()->route('settings')->with('success','Settings updated successfully');
        } else {
            return redirect()->route('settings')->with('failed','Something went wrong');
        }
    }

    public function changeUsername(Request $request)
    {
        $request->validate([
            'username'      => 'required',
        ]);
        $user_data = [];
        if($request->has('username') && $request->username != ''){
            $user_data['username'] = $request->username;
        }
        Auth::user()->update($user_data);
        return redirect()->route('settings')->with('success','Settings updated successfully');
    }
    
    public function databaseReset(Request $request)
    {
        // Artisan::call("migrate:refresh");
        Artisan::call("db:seed");
        return redirect()->route('settings')->with('success','Successfully Reset DB');
    }

    // app/Http/Controllers/SettingController.php

    public function showLocations()
    {
        // Fetch locations and pass them to the view
        $locations = Location::all();
        return view('settings.location', compact('template'));
    }

    public function storeLocation(Request $request)
    {
        // Validate and store the new location
        $request->validate([
            'location' => 'required|string|max:255',
        ]);

        Location::create([
            'name' => $request->input('location'),
        ]);

        return redirect()->route('settings', ['active_tab' => 'locations'])->with('success', 'Location added successfully');
    }

    public function editLocation($id)
    {
        // Find the location and pass it to the view for editing
        $location = Location::findOrFail($id);
        return redirect()->route('settings', ['active_tab' => 'locations'])->with('success','Location Updated successfully');
    }

    public function updateLocation(Request $request, $id)
    {
        // Validate and update the location
        $request->validate([
            'location' => 'required|string|max:255',
        ]);

        $location = Location::findOrFail($id);
        $location->update([
            'name' => $request->input('location'),
        ]);

        return redirect()->route('settings', ['active_tab' => 'locations'])->with('success','Location Updated successfully');
    }

    public function destroyLocation($id)
    {
        // Delete the location
        $location = Location::findOrFail($id);
        $location->delete();

        return redirect()->route('settings', ['active_tab' => 'locations'])->with('success','Location deleted successfully');
    }

    //Template
    public function showtemplate()
    {
        // Fetch locations and pass them to the view
        $locations = Location::all();
        return view('settings.locations', compact('locations'));
    }

    public function storetemplate(Request $request)
    {
        // Validate and store the new location
        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Template::create([
            'name' => $request->input('name'),
            'message' => $request->input('message'),
        ]);

        return redirect()->route('settings', ['active_tab' => 'templates'])->with('success', 'Template added successfully');
    }

    public function edittemplate($id)
    {
        // Find the location and pass it to the view for editing
        $location = Location::findOrFail($id);
        return redirect()->route('settings', ['active_tab' => 'locations'])->with('success','Location Updated successfully');
    }

    public function updatetemplate(Request $request, $id)
    {
        // Validate and update the location
        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $template = Template::findOrFail($id);
        $template->update([
            'name' => $request->input('name'),
            'message' => $request->input('message'),
        ]);

        return redirect()->route('settings', ['active_tab' => 'templates'])->with('success', 'Template updated successfully');
    }

    public function destroytemplate($id)
    {
        // Delete the location
        $location = Template::findOrFail($id);
        $location->delete();

        return redirect()->route('settings', ['active_tab' => 'templates'])->with('success','Template deleted successfully');
    }
}
