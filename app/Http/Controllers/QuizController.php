<?php
namespace App\Http\Controllers;
use App\Helpers\Cmf;
use Illuminate\Http\Request;
use App\Models\dynamicpages;
use App\Models\user;
use App\Models\quizefields;
use App\Models\quizes;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;
use DB;
use Mail;
use File;
use Validator;
use Redirect;
use DataTables;
use PDF;
use Storage;
use App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Image;
use Illuminate\Support\Facades\Hash;
class QuizController extends Controller
{
    public function index()
    {
        $data = DB::table('quizes')->where('delete_status' , 'active')->where('published_status' , 'published')->orderby('order' , 'asc')->get();
        return view('frontend.quiz.index')->with(array('data'=>$data));
    }
}