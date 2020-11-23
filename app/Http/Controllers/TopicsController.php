<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\Category;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use Illuminate\Support\Facades\Auth;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(Request $request,User $user)
    {
        $topics = Topic::with('user', 'category')->withOrder($request->order)->paginate(30);
        $active_users = $user->getActiveUsers();
        return view('topics.index', compact('topics','active_users'));
    }

    public function show(Request $request,Topic $topic)
    {
        if(!empty($topic->slug)&&$topic->slug!=$request->slug){
            return redirect($topic->link(),301);
        }
        return view('topics.show', compact('topic'));
    }

    public function create(Topic $topic)
    {
        $categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories'));
    }

    public function store(TopicRequest $request, Topic $topic)
    {

        $topic = $topic->fill($request->all());
        $topic->user_id = Auth::id();
        $topic->save();
        return redirect()->to($topic->link())->with('success', '帖子创建成功！');
    }

    public function edit(Topic $topic)
    {
        $this->authorize('update', $topic);
        $categories=Category::all();
        return view('topics.create_and_edit', compact('topic','categories'));
    }

    public function update(TopicRequest $request, Topic $topic)
    {
        $this->authorize('update', $topic);
        $topic->update($request->all());
        return redirect()->to($topic->link())->with('success', '帖子更新成功！');
    }

    public function destroy(Topic $topic)
    {
        $this->authorize('destroy', $topic);
        $topic->delete();

        return redirect()->route('topics.index')->with('success', '删除话题成功！');
    }

    public function imageUpload(Request $request, ImageUploadHandler $uploader)
    {
        $data = [
            "success"   => false,
            "msg"       => "上传失败", # optional
            "file_path" => "",
        ];
        if($file=$request->upload_file){
            $result=$uploader->save($file,'topics',Auth::id(),1024);
            if($result){
                $data['file_path']=$result['path'];
                $data['msg']='上传成功！';
                $data['success']=true;
            }
        }
        return $data;
    }
}
