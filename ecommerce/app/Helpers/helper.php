<?php

if(!function_exists("getprofileImage")){
    function getProfileImage(){
        if(auth()->user()->profile){
            return auth()->user()->profile;
        }else{
            return "https://api.dicebear.com/8.x/initials/svg?seed=".auth()->user()->name;
        }
    }
}