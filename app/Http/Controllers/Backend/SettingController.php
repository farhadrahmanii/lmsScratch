<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SmptSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function SmtpSetting()
    {
        $smtp = SmptSetting::findOrFail(1);
        return view('admin.backend.setting.smtp_update', compact('smtp'));
    } //End Of Mehtod




    public function SmtpUpdate(Request $request)
    {
        SmptSetting::findOrFail($request->id)->update([
            'mailer' => $request->mailer,
            'port' => $request->port,
            'host' => $request->host,
            'username' => $request->username,
            'password' => $request->password,
            'encryption' => $request->encryption,
            'from_address' => $request->from_address,
        ]);

        $notification = array(
            'message' => 'Smtp Setting Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    } //End Of Mehtod
}
