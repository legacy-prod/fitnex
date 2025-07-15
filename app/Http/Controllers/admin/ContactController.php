<?php

namespace App\Http\Controllers\admin;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trainer;
use App\Models\User;
use App\Mail\TrainerContacted;
use Illuminate\Support\Facades\Mail;
use Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function _construct()
    {
        $this->middleware('permission:contact-list|contact-create|contact-edit|contact-delete' , ['only' => ['index','store']]);
        $this->middleware('permission:contact-create' , ['only' => ['create','store']]);
        $this->middleware('permission:contact-edit' , ['only' => ['edit','update']]);
        $this->middleware('permission:contact-delete' , ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $uid = Auth::user()->id;
            $query=Contact::orderby('id' , 'desc')->where('id' ,'>' , 0);
            if($request['search'] != ""){
                $query->where('name' , 'like' , '%' . $request['search'] .'%');
            }
            if($request['status'] != "All"){
                if($request['status']==2){
                    $request['status']==0;
                }
                $query->where('status' ,$request['status']);
            }
            $models = Contact::where('agent_id',$uid)->orderby('id' , 'desc')->paginate(10);
            return (string) view('admin.contact.search' , compact('models'));
        }

        $page_title= 'All Contact Me';

        if(Auth::user()->hasRole('Contractor')){
            $uid = Auth::user()->id;
            $models = Contact::where('agent_id',$uid)->orderby('id' , 'desc')->paginate(10);
        }else{
            $uid = Auth::user()->id;
            $models = Contact::where('agent_id',$uid)->orderby('id' , 'desc')->paginate(10);
        }
        return view('admin.contact.index' , compact('models', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title= "Add Contact";
        return view('admin.contact.create' , compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|max:100',
            'phone' => 'required|max:100',
            'message' => 'required|max:1000',
        ]);

        $model = new Contact();

        $model->name = $request->name;
        $model->email = $request->email;
        $model->phone = $request->phone;
        $model->message = $request->message;

        if ($request->has('agent_id')) {
            $model->agent_id = $request->agent_id;
            
            $trainer_id = $request->agent_id;
            $trainer = Trainer::find($trainer_id);
            
            if ($trainer && $trainer->user) {
                Mail::to($trainer->user->email)->send(new TrainerContacted($model));
            }
        }
        
        $model->save();

        return redirect()->back()->with('message', 'Your message has been sent successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model=Contact::where('id' , $id)->first();
        if($model){
            $model->delete();
            return true;
        }
        else{
            return response()->json(['message' => 'Failed'], 404);
        }
    }
}