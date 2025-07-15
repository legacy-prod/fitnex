<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\PageSetting;
use Session;
use Auth;
use File;

class PageSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = PageSetting::where('parent_slug', $request->parent_slug)->first();
        if(empty($model)){
            foreach($request->all() as $key=>$value){
                $obj = $value;

                if(gettype($obj)!='array' && gettype($obj)!='string' && !empty($obj)){
                    $file = $obj;
                    $image = date('dmYHis').'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('/admin/assets/images/page'), $image);
                    $obj = $image;
                }

                PageSetting::create([
                    'parent_slug' => $request->parent_slug,
                    'key' => $key,
                    'value' => isset($obj)?$obj:null,
                ]);
            }
            Session::flash('message', 'Setting added successfully!');
            return redirect()->back();
        }else{
            foreach($request->all() as $key=>$value){
                $page = PageSetting::where('parent_slug', $request->parent_slug)->where('key', $key)->first();

                $obj = $value;
                if(!empty($page)){
                    if(gettype($obj)!='array' && gettype($obj)!='string' && !empty($obj)){
                        $file = $obj;
                        $image = date('dmYHis').'.'.$file->getClientOriginalExtension();
                        $file->move(public_path('/admin/assets/images/page'), $image);
                        $obj = $image;
                    }

                    $page->value = $obj;
                    $page->update();
                }else{
                    if(gettype($obj)!='array' && gettype($obj)!='string' && !empty($obj)){
                        $file = $obj;
                        $image = date('dmYHis').'.'.$file->getClientOriginalExtension();
                        $file->move(public_path('/admin/assets/images/page'), $image);
                        $obj = $image;
                    }

                    PageSetting::create([
                        'parent_slug' => $request->parent_slug,
                        'key' => $key,
                        'value' => isset($obj)?$obj:null,
                    ]);
                }
            }
            Session::flash('message', 'Setting updated successfully!');
            return redirect()->back();
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $model = Page::where('slug', $slug)->first();
        $page_settings = PageSetting::where('parent_slug', $slug)->get(['key', 'value']);
        $page_data = [];
        foreach ($page_settings as $key => $page_setting) {
            $page_data[$page_setting->key] = $page_setting->value;
        }

        if($slug=='home'){
            return View('admin.page_setting.home', compact("model", "page_data"));
        }elseif($slug=='about-us'){
            return View('admin.page_setting.about', compact("model", "page_data"));
        }elseif($slug=='home-about-us'){
            return View('admin.page_setting.home_about', compact("model", "page_data"));
        }elseif($slug=='careers'){
            return View('admin.page_setting.careers', compact("model", "page_data"));
        }elseif($slug=='terms-conditions'){
            return View('admin.page_setting.terms', compact("model", "page_data"));
        }elseif($slug=='contact-us'){
            return View('admin.page_setting.contact', compact("model", "page_data"));
        }elseif($slug=='header'){
            return view('admin.page_setting.header', compact("model", "page_data"));
        }elseif($slug=='footer'){
            return view('admin.page_setting.footer', compact("model", "page_data"));
        }elseif($slug=='privacy-policy'){
            return view('admin.page_setting.privacy', compact("model", "page_data"));
        }
    }

   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
