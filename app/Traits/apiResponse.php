<?php
namespace App\Traits;



Trait ApiResponse{

    public function ApiResponse($message,$datakey,$data,$extraData=[],$success=true,$statusCode=200){

        $Apidata=[
            'success'=>$success,
            'message'=>$message,
            "$datakey"=>$data
        ];
        foreach($extraData as $key=>$data){
            $Apidata[$key]=$data;
        }

//            $Apidata->merge($extraData);

        return response()->json($Apidata,$statusCode);
    }

    function sendFCM($token, $message)
    {

        $fcm_server_key = "AAAAdZfN73k:APA91bFMn8TibD6Tzag4pDnyn_qUskrXO_t63PQC3IX8uAs8Kt6jVhhlNw112drEtbwXfm-24Z-vXiTbMZcoVWW5KfqA2PS76C0aWcASYZrCQU_OZqeE2PvrDaxsP98EySfaQtIbyctO";
        $fcm_server_id = "505058029433";
        $path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';


        $notification = [
            'title' => $message['title'],
            'body' =>$message['message'],
            "data" => $message,
            'icon' => 'myIcon',
            'sound' => 'mySound',
            // "click_action" => isset($message['web_url'])?$message['web_url']:isset($message['action'])?$message['action']:'',
            "click_action" => isset($message['web_url'])?$message['web_url']:'',
        ];
        $extraNotificationData = ["message" => $notification, "moredata" => 'dd'];
        $fcmNotification = [
//            'registration_ids' => $this->tokens, //multple token array
            'to' => $token,
            'notification' => $notification,
            'data' => $extraNotificationData
        ];
        $headers = array(
            'Authorization:key=' . $fcm_server_key,
            'sender:id=' . $fcm_server_id,
            'Content-Type:application/json'
        );
        // Open connection
        $ch = curl_init();
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $path_to_firebase_cm);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        // Execute post
        $result = curl_exec($ch);
        // Close connection
        curl_close($ch);
        return $result;
    }
}