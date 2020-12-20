<?php
namespace PAIG\Front;

use PAIG\Common\Option;

class TokenLogic
{
    /*
     ** Store access token for each request
     */
    private $accessToken;
    /*
     * Store when accessToken is expires
     */
    private $expiresIn;
    /*
     * When the token was created
     */
    private $createdTokenTimestamp;
    /*
     * The URL that handle our token
     */
    private static $url=PAIG_API_ENV==="prod"?PAIG_API_LIVE_URL:PAIG_API_DEV_URL;

    /*
     * Set variable
     */

    public function __construct()
    {
        $this->accessToken=Option::getValue("accessToken");

        $this->expiresIn=Option::getValue("expiresIn");

        $this->createdTokenTimestamp=Option::getValue("createdTokenTimestamp");

        add_action("wp",array($this,"fetchAccessToken"));
    }

    /**
     *
     */
    public function fetchAccessToken(){
//        var_dump($this->haveAccessToken());
//        die;
        if(!$this->haveAccessToken()||!$this->isTokenAlive()){
            $client_key=PAIG_API_ENV==='dev'?'client_id_test':'client_id';
            $client_secret=PAIG_API_ENV==='dev'?'client_secret_test':'client_secret';
            static::requestAccessToken(Option::getValue($client_key),Option::getValue($client_secret));
        }
    }

    /**
     * @return bool
     */
    public function haveAccessToken(){
        return !is_null($this->accessToken)&&!is_null($this->expiresIn)&&!is_null($this->createdTokenTimestamp);
    }

    public function isTokenAlive(){
        return ($this->createdTokenTimestamp+$this->expiresIn)>current_time('timestamp');
    }

    public static function requestAccessToken($client_id,$client_secret){
        $response = wp_remote_post( static::$url, array(
                'method'      => 'POST',
                'timeout'     => 45,
                'blocking'    => true,
                'headers'     => array(),
                'body'        => array(
                    'client_id'=>$client_id,
                    'client_secret'=>$client_secret,
                    'grant_type' => 'client_credentials',
                )
            )
        );

        if(is_wp_error($response)){
            var_dump($response);
        }
        else{
            if($response["response"]["code"]===200){
                $access=json_decode($response["body"]);
                Option::setValues([
                    "accessToken"=>$access->access_token,
                    "expiresIn"=>$access->expires_in,
                    "createdTokenTimestamp"=>current_time( 'timestamp' )
                ]);
            }
        }
        // var_dump($response);
        // die;

    }

    public function storeAccessToken(){

    }
}