<?php

namespace App\Controller\Component;
use Cake\Controller\Component;

class UtilitiesComponent extends Component
{
    public function errorModel($list_errors = [])
    {
        $result = [];
        if(empty($list_errors)) return [];
        foreach($list_errors as $key => $errors){
            if(is_array($errors)){
                foreach($errors as $error){
                    $result[] = $key . ' - ' . $error;
                }
            }else{
                $result[] = $key . ' - ' . $error;
            }
        }
        return $result;
    }
}
