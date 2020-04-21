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

    public function formatPaginationInfo($pagination_info = []){
        $result = [
            'field' => !empty($pagination_info['sort']) ? $pagination_info['sort'] : 'id',
            'sort' => !empty($pagination_info['direction']) ? $pagination_info['direction'] : DESC,
            'page' => !empty($pagination_info['page']) ? intval($pagination_info['page']) : 1,
            'pages' => !empty($pagination_info['pageCount']) ? intval($pagination_info['pageCount']) : 1,
            'perpage' => !empty($pagination_info['perPage']) ? intval($pagination_info['perPage']) : PAGINATION_LIMIT_ADMIN,
            'total' => !empty($pagination_info['count']) ? intval($pagination_info['count']) : 0
        ];

        return $result;
    }
}
