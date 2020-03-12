<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use PHPMailer\PHPMailer\PHPMailer;
class Right
{
    public static function check($permission_name, $action) {
    	$role_id = Auth::user()->role_id;
    	$q = DB::table('role_permissions')
                ->join('permissions', 'permissions.id', '=', 'role_permissions.permission_id')
                ->select('role_permissions.list','role_permissions.insert','role_permissions.delete','role_permissions.update')
                ->where(['role_permissions'.'.role_id' => $role_id, 'permissions.name' => $permission_name]);

        switch ($action) {
        	case 'i':
        		$q = $q->where('role_permissions.insert', 1);
        		break;
        	case 'u':
        		$q = $q->where('role_permissions.update', 1);
        		break;
        	case 'd':
        		$q = $q->where('role_permissions.delete', 1);
        		break;
    		case 'l':
        		$q = $q->where('role_permissions.list', 1);
        		break;	
        	default:
        		break;
        }
	   
       	return $q->count() > 0;
    }
    
    public static function sms($send_to, $subject, $sms)
    {
       
        if (!filter_var($send_to, FILTER_VALIDATE_EMAIL)) 
        {
            return 0;
        }
        $mail = new PHPMailer(true); // notice the \  you have to use root namespace here
        try {
            $mail->isSMTP(); // tell to use smtp
            $mail->CharSet = "utf-8"; // set charset to utf8
            $mail->SMTPAuth = true;  // use smpt auth
            $mail->SMTPSecure = "ssl"; // or ssl
            $mail->Host = "";
            $mail->Port = 465; 
            $mail->Username = "";
            $mail->Password = "";
            $mail->setFrom("", "Master Jobs Cambodia");
            $mail->Subject = $subject;
            $mail->MsgHTML($sms);
            $mail->addAddress($send_to, $send_to);
            $mail->send();
        } catch (phpmailerException $e) {
//            dd($e);
        } catch (Exception $e) {
//            dd($e);
        }
        return 1;
    }
   
    
}