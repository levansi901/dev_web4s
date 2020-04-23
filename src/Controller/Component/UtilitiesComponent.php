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

    public function isDateClient($str = null){
        $matches = [];
        $pattern = '/^([0-9]{1,2})\\/([0-9]{1,2})\\/([0-9]{4})$/';
        if (!preg_match($pattern, $str, $matches)) return false;
        if (!checkdate($matches[2], $matches[1], $matches[3])) return false;
        return true;
    }

    public function isDateTimeClient($str = null){
        $matches = [];
        $pattern = '/^([0-9]{1,2})\\/([0-9]{1,2})\\/([0-9]{4})\s\-\s([0-9]{1,2})\:([0-9]{1,2})$/';
        if (!preg_match($pattern, $str, $matches)) return false;
        if (!checkdate($matches[2], $matches[1], $matches[3])) return false;
        //dd/mm/yyyy - HH:ii
        return true;
    }

    public function isJson($json_str = null){
        return is_string($json_str) && is_array(json_decode($json_str, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }

    public function formatUnicode($str = null) {
        if (empty($str)) {
            return '';
        }

        $unicode = [
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd' => 'đ|Đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i' => 'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ'
        ];
        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, trim($str));
        }
        return $str;
    }

    public function formatSearchUnicode($data = []) {
        $result = [];
        foreach ($data as $k => $item) {            
            if(!empty($item)){
                $result[] = $this->formatUnicode($item);    
            }            
        }

        return !empty($result) ?  implode(' | ', $result) : null;
    }


    public function stringDateToInt($str_date = null){
        $str_date = str_replace('/', '-', $str_date);
        return strtotime(date('Y-m-d', strtotime($str_date) ));
    }

    public function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    public function generateRandomNumber($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789', ceil($length/strlen($x)) )),1,$length);
    }

    public function removeDirectory($directory, $recursively = false, $remove_folder = false){
        foreach (glob("{$directory}/*") as $file) {
            if (is_dir($file)) {
                if ($recursively) {
                    $this->removeDirectory($file, $recursively, $remove_folder);
                    rmdir($file);
                }
            } else {
                if(file_exists($file)) {
                    unlink($file);
                }
            }
        }

        if ($remove_folder) rmdir($directory);
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
