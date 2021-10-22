<?php

namespace App\Http\Controllers;
use App\Http\Resources\articleResponse;
use App\Traits\apiResponse;
use App\Models\{Post,User,Category,Urgent};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\postTrait;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class PostController extends Controller
{
    use postTrait;
    // use apiResponse;
    use ApiResponse;
    public function postStore(Request $request)
    {
        // dd($request)  ;
        // dd(request()->file()->all());
        $file_name = $this->saveimg($request->photo,'images/posts');

            Post::create(
                       [
                        'title'=>$request->title,
                         'post' =>$request->post,
                         'photo' => $file_name,
                         'category_id'=>$request->category_id
                        ]
                       );

                       $user = User::where('email','hasan@gmail.com')->first();

                       if($user && $user->fcm_token){
                           $message=[
                               'title'=>'قام مستخم بانشاء بوست',
                               "message"=>$request->title
                           ];
                           $this->sendFCM($user->fcm_token,$message);
                       }

            return back()->with('success','Added Successfuly');
    }
    // public function postStore(Request $request){
    //     Post::create(
    //         [
    //             'title'=>$request->title,
    //             'post' =>$request->post,
    //         ]
    //         );
    //         return back();
    // }

    public function postShow(){
        $categories = Category::get();
        return view('website.post',compact('categories'));
    }

    public function postTable(){
//        Role::create(['name'=>'writer']);
//        Permission::create(['name'=>'manage post']);
        $user = auth()->user();
//        $user->givePermissionTo('manage post');
        $user->assignRole('writer');
        $role->givePermissionTo('manage post');
//      $posts = Post::get();
////        $posts = Post::paginate(10);
////        $post = Post::select('id','title','created_at')->get();
////        return $this->apiResponse('تمت العملية بنجاح','posts',$post,[
////             'has_more_page'=>$posts->hasMorePages(),
////            ]);
//        $user = auth()->user();
////        Role::create(['name'=>'writer']);
//            $user->assignRole('admin');
//        Permission::create(['name'=>'create post']);
////        $test = $user->can('create user');
////            return $test;
//      return view('website.postTable',compact('posts'));
//
////     $time = Post::find($id)->created_at->diffForHumans();
    }


    public function editPost($id){
        $posts = Post::select('title','post','id')->find($id);
        return view('website.postEdit',compact('posts'));

    }

    public function postUpdate(Request $request,$id){
        $user = Post::find($id);
        $user->update([
            "title"=>$request->title,
            "post"=>$request->post,
        ]);
        return redirect()->route('admin.postTable');
    }

    public function postDelete($id)
    {
        $user = Post::find($id);
        $user -> delete();
        return response()->json(['status'=>'post deleted succesfully']);
    }

   ############################----category---######################
   public function categoryAdd(){
       return view('website.categoryAdd');
   }

   public function categoryStore(Request $request){

    Category::create([
        'name'=>$request->name,
    ]);
    return back();
   }

    public function urgentAdd(){
        return view('website.addUrgent');
    }

    public function urgentStore(Request $request){

        Urgent::create([
            'name'=>$request->name,
        ]);
        return back();
    }
}
