<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\Hoteldetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use phpDocumentor\Reflection\Types\Boolean;

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
        return view('home');
    }

    public function handleAdmin()
    {
        return view('admin.handleAdmin');
    }

    public function handleStaff()
    {
        return view('staff.handleStaff');
    }

    public function userBookStore()
    {
        $data = Hoteldetail::all()->where('status', '=', 0);
        return view('booknow', compact('data'));
    }

    public function userBookView()
    {
        $id = Auth::id();
        $data = Booking::all()->where('user_id', '=', $id);
        return view('viewbooking', compact('data'));
    }

    public function userHotelBookStore($id)

    {
        $data = Hoteldetail::find($id);
        return view('booking', compact('data'));
    }

    function ajaxPostBookDetails(Request $request)
    {
        $data = new Booking();
        $data->user_id = $request->input('user_id');
        $data->hoteldetail_id = $request->input('hoteldetail_id');
        $data->room_no = $request->input('room_no');
        $data->no_of_days = $request->input('no_of_days');
        $data->total_cost = $request->input('total_cost');
        $data->check_in = $request->input('check_in');
        $data->check_out = $request->input('check_out');
        $data->save();
        $dataH = Hoteldetail::find($request->input('hoteldetail_id'));
        $dataH->status = 1;
        $dataH->save();
        return redirect()->route('viewbooking');
    }

    public function userDestroy($id, $roomno)
    {
        $delete = new Booking();
        $delete::find($id)->delete();
        $dataH = Hoteldetail::where('room_no', $roomno)->first();
        $dataH->status = 0;
        $dataH->save();
        return redirect()->route('viewbooking')->with('warning', 'You Have Been Cancel Your Booking.');
    }

    public function userApproveByStaff()
    {
        $data =  Booking::all()->where('status', '=', 0);
        return view('staff.userapprovebystaff', compact('data'));
    }

    public function roomdetails($id)
    {
        $data = Hoteldetail::find($id);
        return view('staff.roomdetails', compact('data'));
    }

    public function reject($id)
    {
        $dataH = Booking::findOrFail($id);
        $dataH->status = 2;
        $dataH->save();
        return redirect()->route('staff.userapprove');
    }

    public function approve($id)
    {

        $data = Booking::find($id);
        $data->status = 1;
        $data->save();
        return redirect()->route('staff.userapprove');
    }

    public function userCheckOut()
    {
        $data =  Booking::all()->where('status', '=', 1);
        return view('staff.approveduserbystaff', compact('data'));
    }

    public function checkout($id, $hotel_id)
    {
        Booking::find($id)->delete();
        $dataH = Hoteldetail::where('id', $hotel_id)->first();
        $dataH->status = 0;
        $dataH->save();
        return redirect()->route('staff.userCheckOut');
    }

    public function ajaxGetUserDetails($id)
    {
        return response()->json(User::find($id));
    }
}
