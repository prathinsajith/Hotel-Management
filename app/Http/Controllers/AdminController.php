<?php

namespace App\Http\Controllers;

use App\Models\Hoteldetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $data = Hoteldetail::all();
        return view('admin.hotelDetails', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hotelDetailsInsert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([

            'imagepath' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',

        ]);
        $image = $request->file('imagepath');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);

        $data = new Hoteldetail();
        $data->room_no = $request->input('room_no');
        $data->cost = $request->input('cost');
        $data->category = $request->input('category');
        $data->guest_no = $request->input('guest_no');
        $data->room_size = $request->input('room_size');
        $data->imagepath = $new_name;
        $data->save();
        return redirect()->route('hotelDetails.index')->with('success', '  Successfully Inserted.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Hoteldetail::find($id);
        return view('admin.hotelDetailsEdit', compact('data'));
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
        $data = Hoteldetail::find($id);
        // $image = $request->file('imagepath');
        // $new_name = rand() . '.' . $image->getClientOriginalExtension();
        // $image->move(public_path('images'), $new_name);
        $data->room_no = $request->input('room_no');
        $data->cost = $request->input('cost');
        $data->category = $request->input('category');
        $data->guest_no = $request->input('guest_no');
        $data->room_size = $request->input('room_size');
        // $data->imagepath = $new_name;
        $data->save();
        return redirect()->route('hotelDetails.index')->with('success', 'Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = new Hoteldetail();
        $delete::findOrFail($id)->delete();
        return redirect()->route('hotelDetails.index')->with('warning', '  Successfully Deleted.');
    }


    public function staffRegistration()
    {
        return view('admin.staffRegistration');
    }

    public function staffRegistrationStore(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $data = new User();
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->is_admin = $request->input('is_admin');
        $data->password = Hash::make($request->input('password'));
        $data->save();
        return redirect()->route('admin.staffList')->with('success', 'Successfully Registered');
    }

    public function staffList()
    {
        $data =  User::all()->where('is_admin', '=', 2);
        return view('admin.stafflist', compact('data'));
    }

     public function staffDestroy($id)
    {
        $delete = new User();
        $delete::findOrFail($id)->delete();
        return redirect()->route('admin.staffList')->with('warning', '  Successfully Deleted.');
    }
}
