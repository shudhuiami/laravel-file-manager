<?php

namespace zobayer\LaravelFileManager\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class LaravelFileManager extends Model
{
    protected $table = 'laravel_file_manager';

    public function getAttrsAttribute($value)
    {
        return @unserialize($value);
    }

    public function getFilePathAttribute($value)
    {
        $ext = explode(".",$value)[1];
        $app_url =  config('filemanager.APP_URL');
        $app_storage_type =  config('filemanager.STORAGE_DIR');
        if (in_array(strtolower($ext), config('filemanager.IMAGE_EXT'))) {
            $dir_name = 'images';
        }elseif (in_array(strtolower($ext), config('filemanager.VIDEO_EXT'))) {
            $dir_name = 'videos';
        }else{
            $dir_name = 'files';
        }
        if($app_storage_type == "public"){
            return $app_url.'/uploads/'.$dir_name.'/'.$value;
        }else{
            return $app_url.'/storage/media/'.$dir_name.'/'.$value;
        }
    }
}
