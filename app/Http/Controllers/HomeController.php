<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User; 
use App\Models\MemberDirectory;
use App\Models\DocumentRepository;
use App\Models\Project;
use App\Models\JobPost;
use App\Models\ContactUs;
use App\Models\Contact;
use App\Models\ClientContact;
use App\Models\news_letter;
use App\Models\Trainer;
use App\Models\Testimonial;
use App\Models\Category; 
use Google\Service\CivicInfo\Resource\Elections;
use Session;
class HomeController extends Controller
{
    /** 
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->hasRole('Admin')) {
            // Admin dashboard
            $page_title = 'Admin Dashboard';
            $total_users = User::where('id', '!=', 1)->count();  
            $total_contactus = ContactUs::where('status', 1)->count();
            $total_jobpost = JobPost::where('status', 1)->count();
            $testimonials = Testimonial::where('status', 1)->count();
            $total_trainer = Trainer::where('status', 1)->count();
            $total_category = Category::where('status', 1)->count(); 
            return view('admin.dashboard.dashboard', compact('page_title', 'total_users','total_jobpost', 'total_contactus','total_trainer','testimonials','total_category'));
        } elseif (Auth::check() && Auth::user()->hasRole('Member')) {
            // Member dashboard
            $page_title = 'Dashboard';
            return view('website.member-dashboard.dashboard', compact('page_title'));
        } elseif (Auth::check() && Auth::user()->hasRole('Contractor')) {
            // Member dashboard
            $page_title = 'Dashboard';
            $total_contact = Contact::where('user_id', Auth::user()->id)->count();
            $total_client_contact = ClientContact::where('user_id', Auth::user()->id)->count();
            return view('website.contractor-dashboard.dashboard', compact('page_title', 'total_contact', 'total_client_contact'));
        } elseif (Auth::check() && Auth::user()->hasRole('EPC Developer')) {
            // EPC Developer dashboard
            $page_title = 'Dashboard'; 
            $total_client_contact = ClientContact::where('epc_developer_id', Auth::user()->id)->count(); 
            $total_projects = Project::where('created_by', Auth::user()->id)->count();
            $total_member_directory = MemberDirectory::where('created_by', Auth::user()->id)->count();
            return view('website.epcdeveloper-dashboard.dashboard', compact('page_title', 'total_client_contact', 'total_projects', 'total_member_directory'));
        } else {
            return redirect()->route('/');
        }
    }
}
