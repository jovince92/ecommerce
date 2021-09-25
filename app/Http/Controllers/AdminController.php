<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Features;
use Illuminate\Routing\Pipeline;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Responses\LoginResponse;
use Intervention\Image\Facades\Image;
use Illuminate\Contracts\Auth\StatefulGuard;
use Laravel\Fortify\Contracts\LogoutResponse;
use App\Actions\Fortify\AttemptToAuthenticate;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Laravel\Fortify\Contracts\LoginViewResponse;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use App\Actions\Fortify\RedirectIfTwoFactorAuthenticatable;
use App\Models\Roles;

class AdminController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
         
    }

    public function loginForm(){
    	return view('auth.admin.login', ['guard' => 'admin']);
    }

    /**
     * Show the login view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LoginViewResponse
     */
    public function create(Request $request): LoginViewResponse
    {
        return app(LoginViewResponse::class);
    }

    /**
     * Attempt to authenticate a new session.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return mixed
     */
    public function store(LoginRequest $request)
    {
        return $this->loginPipeline($request)->then(function ($request) {
            return app(LoginResponse::class);
        });
    }

    /**
     * Get the authentication pipeline instance.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Pipeline\Pipeline
     */
    protected function loginPipeline(LoginRequest $request)
    {
        if (Fortify::$authenticateThroughCallback) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                call_user_func(Fortify::$authenticateThroughCallback, $request)
            ));
        }

        if (is_array(config('fortify.pipelines.login'))) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                config('fortify.pipelines.login')
            ));
        }

        return (new Pipeline(app()))->send($request)->through(array_filter([
            config('fortify.limiters.login') ? null : EnsureLoginIsNotThrottled::class,
            Features::enabled(Features::twoFactorAuthentication()) ? RedirectIfTwoFactorAuthenticatable::class : null,
            AttemptToAuthenticate::class,
            PrepareAuthenticatedSession::class,
        ]));
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LogoutResponse
     */
    public function destroy(Request $request): LogoutResponse
    {
        $this->guard->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return app(LogoutResponse::class);
    }

    public function useraccounts(){
        $users = User::all();
        return view('admin.users.users',compact('users'));
    }


    public function index(){
        $orders  = Order::all();
        $todaysale = Order::whereDate('created_at', Carbon::today())->sum('amount');
        $thismonthsale = Order::whereMonth('created_at', date('m'))->sum('amount');
        $newusersthisweek = User::where('created_at','>=',Carbon::now()->subDays(7))->get();
        $productssoldthismonth = OrderDetail::whereMonth('created_at', date('m'))->sum('qty');

        $orders_summary = DB::table('statuses')
            ->leftJoin('orders','orders.status','=','statuses.id')
            ->leftJoin('order_details','order_details.order_id','=','orders.id')
            ->select('statuses.id','statuses.status',DB::raw('sum(orders.amount) AS totalamount'),DB::raw('sum(order_details.qty) AS totalproducts'),DB::raw('count(distinct orders.id) AS qty'))
            ->orderBy('statuses.id','ASC')
            ->groupBy('statuses.id','statuses.status')
            ->get();
        
        return view('admin.index',compact('orders','todaysale','thismonthsale','newusersthisweek','productssoldthismonth','orders_summary'));
    }

    public function employees_index (){
        $employees = Admin::with('role')->where('is_master_admin',0)->get();
        return view('admin.users.employees',compact('employees'));
    }

    public function employees_create (){
        return view('admin.users.employees_create');
    }

    public function employees_store (Request $request){
        
        
        
        $data=$request->validate([
            'password' =>'required|confirmed',
        ]);

        $image_name="";
        if($request->file('image')){            
            $image = $request->file('image') ;
            $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(225,225)->save(public_path('storage/profile-photos/admin/'.$image_name));             
        }

        $query=Admin::create([
            'name'=>$request->name,
            'email'=>$request->email,            
            'phone'=>$request->phone,            
            'profile_photo_path'=>$image_name,
            'password'=>Hash::make($request->password)
        ]);

        //dd($query);

        $query2 = Roles::create([
            'admin_id'=>$query->id,
            'orders'=>$request->orders,
            'brands'=>$request->brands,
            'categories'=>$request->categories,
            'products'=>$request->products,
            'sliders'=>$request->sliders,
            'coupons'=>$request->coupons,
            'shipping'=>$request->shipping,
            'users'=>$request->users,
            'blogs'=>$request->blogs,
            'sitesettings'=>$request->sitesettings,
        ]);

        $toastrMsg=array(
            'message' => 'Employee registered!',
            'alert-type' => 'info'
        );
        return redirect()->route('employees.all')->with($toastrMsg);

    }

    public function employees_delete($id){
        $data=Admin::findOrFail($id);
        @unlink(public_path('storage/profile-photos/admin/'.$data->profile_photo_path));
        $data->delete();
        $toastrMsg=array(
            'message' => 'Employee deleted!',
            'alert-type' => 'info'
        );
        return redirect()->route('employees.all')->with($toastrMsg);
    }

    public function employees_edit($id){
        $employee = Admin::with('role')->where('id',$id)->first();
        return view('admin.users.employees_edit',compact('employee'));
    }


    public function employees_update(Request $request){
        
        $id=$request->id;

        $image_name="";
        

        $data=Admin::findOrFail($id);

        if($request->file('image')){          
            @unlink(public_path('storage/profile-photos/admin/'.$data->profile_photo_path));
            
            $image = $request->file('image') ;
            
            $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(225,225)->save(public_path('storage/profile-photos/admin/'.$image_name));             
        }else{
            $image_name=$data->profile_photo_path;
        }

        $data->update([
            'name'=>$request->name,
            'email'=>$request->email,            
            'phone'=>$request->phone,            
            'profile_photo_path'=>$image_name,            
        ]);



        Roles::where('admin_id',$id)->update([            
            'orders'=>$request->orders,
            'brands'=>$request->brands,
            'categories'=>$request->categories,
            'products'=>$request->products,
            'sliders'=>$request->sliders,
            'coupons'=>$request->coupons,
            'shipping'=>$request->shipping,
            'users'=>$request->users,
            'blogs'=>$request->blogs,
            'sitesettings'=>$request->sitesettings,
        ]);

        $toastrMsg=array(
            'message' => 'Employee updated!',
            'alert-type' => 'info'
        );
        return redirect()->route('employees.all')->with($toastrMsg);
    }

}

