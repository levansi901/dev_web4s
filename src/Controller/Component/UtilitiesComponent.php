<?php

namespace App\Controller\Component;
use Cake\Controller\Component;

class UtilitiesComponent extends Component
{
    public function errorModel($list_errors = [])
    {
        $result = [];
        foreach($save->errors() as $errors){
            if(is_array($errors)){
                foreach($errors as $error){
                    $result[] = $error;
                }
            }else{
                $result[] = $errors;
            }
        }
        return $result;
    }
}
