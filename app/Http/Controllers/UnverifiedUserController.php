<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use DB;
use Validator;
use App\Models\UnverifiedUser;
use App\Models\VerifiedUser;
use App\Models\User;
use Yajra\Datatables\Datatables;
use App\Models\Notification;
class UnverifiedUserController extends Controller
{

    public function index()
    {
        return View::make('unverifiedusers.index');
    }

    public function getUnverifiedUser()
    {

        $unverifiedusers = UnverifiedUser::select('*');
        return  Datatables::of($unverifiedusers)
        ->addColumn('action', 'unverifiedusers.action')
        ->make();

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $unverifieduser = UnverifiedUser::find($id);
        return View::make('unverifiedusers.edit',compact('unverifieduser'));
    }


    public function update(Request $request, $id)
    {

          $this->validate($request, [
            'fname' => 'required|min:2|max:200',
            'mname' => 'required|min:2|max:200',
            'lname' => 'required|min:2|max:200',
            'gender'=> 'required|min:2|max:20',
            'birthdate'=> 'required',
            'address' => 'required',
            'contact' => 'numeric',
            'email'=> 'required|min:2|max:200',
            'user_id'=> 'required|min:2|max:200',
        ]);

         //  dd($request->all());

        
        $unverifieduser = UnverifiedUser::find($id);
        //   dd($unverifieduser);
        $verifieduser = new VerifiedUser; 
        $verifieduser ->fname= $request->fname;
        $verifieduser ->mname= $request->mname;
        $verifieduser ->lname= $request->lname;
        $verifieduser ->gender= $request->gender;
        $verifieduser ->birthdate= $request->birthdate;
        $verifieduser ->address= $request->address;
        $verifieduser ->contact= $request->contact;
        $verifieduser ->email= $request->email;
        $verifieduser ->id_type = $unverifieduser->id_type;
        $verifieduser ->id_number =$unverifieduser->id_number;
        $verifieduser ->id_picture_front = $unverifieduser->id_picture_front;
        $verifieduser ->id_picture_back = $unverifieduser->id_picture_back ;
        $verifieduser ->face_img = $unverifieduser->face_img;
        $verifieduser ->status= "Verified";
        $verifieduser ->user_id = $request->user_id;
        $verifieduser ->save();

        //  VerifiedUser::create($request->all());


         $username = DB::table('users')
         ->join('unverified_users', 'users.id', '=', 'unverified_users.user_id')
         ->select('users.name', 'unverified_users.user_id')
         ->where('unverified_users.id', '=', $id)
         ->first();

         $notification_message = $username->name.", Your account is now verified!";

         $notification_status = "unread";


        //  dd( $username);


         $notification = Notification::create([
             'message' =>  $notification_message,
             'status' =>  $notification_status,
             'user_id' =>$username->user_id,
          ]);
          $notification->save();


         $user = DB::table('users')
            ->join('unverified_users', 'users.id', '=', 'unverified_users.user_id')
            ->select('unverified_users.user_id')
            ->where('unverified_users.id', '=', $id)
            ->update(['role'=>'verified_user']);
            // dd($user);


            // $username = DB::table('users')
            // ->join('unverified_users', 'users.id', '=', 'unverified_users.user_id')
            // ->select('*')
            // ->where('unverified_users.id', '=', $id)
            // ->first();

         $unverifieduser = UnverifiedUser::find($id);
         $unverifieduser->delete();

         return Redirect::to('unverifieduser')->with('success','Unverified User updated!');

    }

    public function reject(Request $request, $id)
    {
        // dd($request->input('message'));

        $username = DB::table('users')
         ->join('unverified_users', 'users.id', '=', 'unverified_users.user_id')
         ->select('users.name', 'unverified_users.user_id', 'unverified_users.verification_attempt')
         ->where('unverified_users.id', '=', $id)
         ->first();

         $notification_status = "unread";
         $notification = Notification::create([
             'message' =>  $request->input('message'),
             'status' =>  $notification_status,
             'user_id' =>$username->user_id,
         ]);
         $notification->save();

         if($username->verification_attempt == 5)
            {
                $notification_message = $username->name.", Your account is banned!, You exceeded the verification attempt, limit is 5.";
                $notification = Notification::create([
                    'message' =>  $notification_message,
                    'status' =>  $notification_status,
                    'user_id' =>$username->user_id,
                ]);
                $notification->save();

                $unverifieduser = UnverifiedUser::find($id);

                $unverifieduser->update(['status'=>'Banned']);
            }

         else {
            $notification_message = $username->name.", Your account is rejected!";
            $notification = Notification::create([
                'message' =>  $notification_message,
                'status' =>  $notification_status,
                'user_id' =>$username->user_id,
              ]);
              $notification->save();

              $unverifieduser = UnverifiedUser::find($id);

              $attempt = $unverifieduser->verification_attempt + 1;

              $unverifieduser->update(['status'=>'Rejected', 'verification_attempt'=>$attempt]);

          }
          

         return Redirect::to('unverifieduser')->with('success','Unverified User updated!');

    }

    public function destroy($id)
    {

        $deleteuser = DB::table('users')
            ->join('unverified_users', 'users.id', '=', 'unverified_users.user_id')
            ->select('unverified_users.user_id')
            ->where('unverified_users.id', '=', $id)
            ->delete();


            // dd($deleteuser);
        $unverifieduser = UnverifiedUser::find($id);
        $unverifieduser->delete();

         return Redirect::to('unverifieduser')->with('success','Unverified User deleted!');
    }

}
