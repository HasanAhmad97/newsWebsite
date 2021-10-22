<?php




namespace App\Http\Controllers;


use App\Models\User;
use App\Notifications\normalNotification;
use App\Traits\apiResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\HasDatabaseNotifications;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Notification;
class NotificationController extends Controller
{
    use HasDatabaseNotifications;
    use Notifiable;
    use ApiResponse;
    public  function  index(){
        $data['users']=User::whereNotNull('fcm_token')->get();
        return view('notification.index',$data);
    }

    public function sendNotification(Request $request){

        $request->validate([
            'title'=>'required',
            'message'=>'required',
            'user_id'=>'required'
        ]);
        $user = User::find($request->user_id);

        if($user && $user->fcm_token){
            $message=[
                'title'=>$request->title,
                "message"=>$request->message
            ];
            $this->sendFCM($user->fcm_token,$message);
//            $this->notify(new normalNotification($message));
            Notification::send($user,new normalNotification($message));
        }

        return redirect()->back()->with(['success','تم ارسال الاشعار بنجاح']);
    }
}
