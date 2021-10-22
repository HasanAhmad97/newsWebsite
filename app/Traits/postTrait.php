<?php


namespace App\Traits;

/**
 * 
 */
Trait postTrait
{
    public function saveimg($photo,$folder){
        
        $file_Extension= $photo->getClientOriginalExtension();
        $file_name = time().'.'.$file_Extension;
        $path = $folder;
        $photo->move($path,$file_name);

        return $file_name;
    }
}
















?>