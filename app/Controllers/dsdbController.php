<?php
namespace App\Controllers;

use Liman\Toolkit\Shell\Command;


class dsdbController {

     function listModify(){


        $data = [];
        $json= runCommand('cat /var/log/dsdb_json_audit.log | grep  \'"operation": "Modify"\'');
        $json_array=explode("\n",$json);
        for ($i = 0; $i < sizeof($json_array);$i++){
            $obj = json_decode($json_array[$i]);
            $data[] = [
                "userSid" => $obj->dsdbChange->userSid,
                "dn" => $obj->dsdbChange->dn,
                "transactionId" => $obj->dsdbChange->transactionId
            ];
        }
        
        
        
        
        return view('table', [
            "value" => $data,
            "title" => ["userSid","dn","transactionId"],
            "display" => ["userSid","dn","transactionId"],    
        ]);
    

    }
    function listAdd(){
     
        $json= runCommand('cat /var/log/dsdb_json_audit.log | grep \'"operation": "Add"\'');
        $data = [];
        $json_array=explode("\n",$json);
        for ($i = 0; $i < sizeof($json_array);$i++){
            $obj = json_decode($json_array[$i]);
            $data[] = [
                "userSid" => $obj->dsdbChange->userSid,
                "dn" => $obj->dsdbChange->dn,
                "transactionId" => $obj->dsdbChange->transactionId
            ];
        }
        
       
        return view('table', [
            "value" => $data,
            "title" => ["userSid","dn","transactionId"],
            "display" => ["userSid","dn","transactionId"],    
        ]);
    

    }
    function listDelete(){
       
        $json= runCommand('cat /var/log/dsdb_json_audit.log | grep  \'"operation": "Delete"\''); 
        $data = [];
        $json_array=explode("\n",$json);
        for ($i = 0; $i < sizeof($json_array);$i++){
            $obj = json_decode($json_array[$i]);
            $data[] = [
                "userSid" => $obj->dsdbChange->userSid,
                "dn" => $obj->dsdbChange->dn,
                "transactionId" => $obj->dsdbChange->transactionId
            ];
        }
        
       return view('table', [
            "value" => $data,
            "title" => ["userSid","dn","transactionId"],
            "display" => ["userSid","dn","transactionId"],    
        ]);
    

    }
}