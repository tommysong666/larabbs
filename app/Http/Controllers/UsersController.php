<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    //
    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['show']]);
    }

    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('update',$user);
        return view('users.edit',compact('user'));
    }

    public function update(UserRequest $request,ImageUploadHandler $uploader,User $user)
    {
        $this->authorize('update',$user);
        $data=$request->except('email');
        if($request->avatar){
            $result=$uploader->save($request->avatar,'avatars',$user->id,416);
            if($result){
                $data['avatar']=$result['path'];
            }
        }
        $user->update($data);
        return redirect()->route('users.show',$user)->with('success','更新资料成功！');
    }
}
