<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud
 * Date: 4/1/2019
 * Time: 2:44 PM
 */

namespace App\Helpers;


class FCM
{

    #API access key from Google API's Console
    private $key = 'AAAAQnwse2Q:APA91bEUKEo-DBgcYQV1pu1DAzKz1p2W6XyEoVhqViLUTxX9H2xWD-B4aj-NOReXwfPl5dGnasOB0teu4qWFPso2NF6tSjo8CI2J73faIHaW0w5WNQeRQW15ySlAwWYfr0bjYAKuVgkW';

    public function send(array $registrationIds, $title, $body, $data)
    {
        $msg = [
            'body' 	=> $body,
            'title'	=> $title,
            'icon' => 'myicon',
            'sound' => 'mySound'
        ];


        $fields = [
            'registration_ids' => $registrationIds,
            'notification' => $msg,
            'data' => $data
        ];

        $headers = [
            'Authorization: key=' . $this->key,
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );

        return $result;
    }



}