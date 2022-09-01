<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;
use App\Http\Requests\Admin\ProfileSetting\UpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileSettingsController extends AdminBaseController
{


    public function __construct()
    {
        parent::__construct();
        $this->settingOpen = 'active';
        $this->pageTitle = 'Settings';
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function edit()
    {

        $this->csettingOpen = 'active';
        $this->profileSettingActive = 'active';
        $this->admin = \admin();
        return View::make('admin.profile_settings.edit', $this->data);
    }

    public function update_login(UpdateRequest $request)
    {
        $admin = \admin();
        $data = $request->all();
        $data['type'] = $admin->type;
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $admin->update($data);

        return Reply::success('messages.updateSuccess');
    }
   
    public function update(Request $request)
    {
        // $validator = Validator::make($request->all(),[
        //     'current' => 'required|max:255',
        //     'password' => 'required|max:255|min:8',
		// ]);

		// if($validator->fails())
		// {
        //     return response()->json(['status'=>'error','message' => $validator->errors()->first()]);
        // }

        $admin = \admin();
        $data = $request->all();
        $data['type'] = $admin->type;
            if($data){
                if(Hash::check($request->current,$admin->password)){
                    $admin->password =  bcrypt($request->password);
                    $admin->save();
                    return response()->json(['status'=>'success']);
                }else{
                    return response()->json(['status'=>'error','message' => 'Enter valid current password!']);
                }   
            }
        // $admin = \admin();
        // $data = $request->all();
        // $data['type'] = $admin->type;
        
        // if (isset($data['password'],$request->current)) {
        //     $data['password'] = bcrypt($data['password']);
        // }

        // $admin->update($data);

        return Reply::success('messages.updateSuccess');
    }


}