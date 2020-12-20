<?php


namespace PAIG\Front;


use PAIG\Common\Helper;
use PAIG\Common\Option;

class SocialSharing
{
    private $url;

    public function __construct()
    {
        $this->url=PAIG_API_ENV==="prod"?PAIG_API_URL:PAIG_DEV_API_URL;
        add_action("wp_head",array($this,"checkRobotCrawlers"),5);
    }

    public function crawlerDetect($USER_AGENT)
    {
        $crawlers = array(
            "Google","facebookexternalhit","Twitterbot","Pininterest","Google"
        );
        foreach($crawlers as $crawler){
            if(stristr($USER_AGENT,$crawler)){
                return true;
            }
        }

        return false;
    }

    public function checkRobotCrawlers(){
        global $wp;
        if(!is_single()) return false;
        $display_id=$wp->query_vars["display_id"];
        $single_pageURL=$this->url."/list/detail/".$display_id;
        $option=Option::getValue("accessToken");
        $response=wp_remote_get($single_pageURL,[
            'headers' => array(
                'Content-Type' => 'application/json',
                'authorization' => 'Bearer '.$option
            )
        ]);
        if(is_wp_error($response)) return false;
        if($response["response"]["code"]===200){
            $property=json_decode($response["body"]);
            $image="";
            if(is_object($property->attachments)){
                $image=is_array($property->attachments->photo)?$property->attachments->photo[0]:"";
            }
            $response=[
                "title"=>sanitize_text_field($property->title),
                "image"=>esc_url($image),
                "description"=>sanitize_text_field($property->description)
            ];
            Helper::view("social/social",$response);
        }
    }
}