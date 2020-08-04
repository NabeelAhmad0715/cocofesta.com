<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\GeneralSetting;
use App\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\ImageManager;

class GeneralSettingController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'site_logo' => ['required', 'image'],
            'favicon_icon' => ['required', 'image'],
            'site_name' => ['required', 'string', 'max:255'],
            'admin_email' => ['nullable', 'email'],
            'from_email' => ['nullable', 'email'],
            'reply_email' => ['nullable', 'email'],
            'auto_respond_email' => ['nullable', 'email'],
            'support_email' => ['nullable', 'email'],
        ]);

        $siteLogo = $request->site_logo;
        $filename = Str::random(15) . '.' . $siteLogo->extension();
        Storage::putFileAs("public", $siteLogo, $filename);
        $data['site_logo'] = $filename;

        $faviconIcon = $request->favicon_icon;
        $filename = Str::random(15) . '.' . $faviconIcon->extension();
        Storage::putFileAs("public", $faviconIcon, $filename);
        $data['favicon_icon'] = $filename;

        GeneralSetting::create($data);
        $request->session()->flash('message', 'General Settings created successfully');
        $request->session()->flash('alert-class', 'alert alert-success');
        return redirect()->route('general-settings.edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $generalSettings = GeneralSetting::first();
        if ($generalSettings) {
            return view('admin.general-settings.edit', compact('generalSettings'));
        } else {
            return view('admin.general-settings.create');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $settings = GeneralSetting::first();

        $data = $request->validate([
            'site_logo' => ['nullable'],
            'favicon_icon' => ['nullable'],
            'site_name' => ['required', 'string', 'max:255'],
            'admin_email' => ['nullable', 'email'],
            'from_email' => ['nullable', 'email'],
            'reply_email' => ['nullable', 'email'],
            'auto_respond_email' => ['nullable', 'email'],
            'support_email' => ['nullable', 'email'],
        ]);

        if ($request->site_logo) {
            $siteLogo = $request->site_logo;
            $filename = Str::random(15) . '.' . $siteLogo->extension();
            Storage::putFileAs("public", $siteLogo, $filename);
            $data['site_logo'] = $filename;
        }

        if ($request->favicon_icon) {
            $faviconIcon = $request->favicon_icon;
            $filename = Str::random(15) . '.' . $faviconIcon->extension();
            Storage::putFileAs("public", $faviconIcon, $filename);
            $data['favicon_icon'] = $filename;
        }

        $settings->update($data);

        $request->session()->flash('message', 'General Settings updated successfully');
        $request->session()->flash('alert-class', 'alert alert-success');
        return redirect()->route('general-settings.edit');
    }
}
