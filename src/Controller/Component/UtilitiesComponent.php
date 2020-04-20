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

    public function isStringDate($str_date = null){
        $result = false;
        if(empty($str_date)) return false;

        $matches = [];
        $pattern = '/^([0-9]{1,2})\\/([0-9]{1,2})\\/([0-9]{4})$/';
        if (!preg_match($pattern, $str_date, $matches)) return false;
        if (!checkdate($matches[2], $matches[1], $matches[3])) return false;
        return true;
    }

    public function stringDateToInt($str_date = null){
        $str_date = str_replace('/', '-', $str_date);
        return strtotime(date('Y-m-d', strtotime($str_date) ));
    }

}
