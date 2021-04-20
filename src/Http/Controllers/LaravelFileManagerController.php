<?php

namespace zobayer\LaravelFileManager\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use zobayer\LaravelFileManager\Models\LaravelFileManager;

class LaravelFileManagerController extends Controller
{
    public function AddFile(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'media' => 'required|file',
        ]);
        if ($validator->fails()) {
            return ['status' => 5000, 'error' => $validator->errors()];
        }
        try {
            $RequestFile = $request->file('media');
            $filePath = null;
            $media_type = 3;
            $new_name = '';


            $storage_dir =  config('filemanager.STORAGE_DIR');

            if($storage_dir == "public"){
                if (in_array(strtolower($RequestFile->getClientOriginalExtension()), config('filemanager.IMAGE_EXT'))) {
                    if (!file_exists(public_path('uploads/images'))) {
                        mkdir(public_path('uploads/images'),777, true);
                    }
                    $bytes = random_bytes(20);
                    $FileName = bin2hex($bytes).'.'.$RequestFile->getClientOriginalExtension();
                    $upload_file_path = public_path('uploads\images').'\\'.$FileName;
                    move_uploaded_file( $_FILES['media']['tmp_name'], $upload_file_path);
                    $media_type = 1;
                    $new_name = $FileName;
                }elseif (in_array(strtolower($RequestFile->getClientOriginalExtension()), config('filemanager.VIDEO_EXT'))) {
                    if (!file_exists(public_path('uploads/videos'))) {
                        mkdir(public_path('uploads/videos'),777, true);
                    }
                    $bytes = random_bytes(20);
                    $FileName = bin2hex($bytes).'.'.$RequestFile->getClientOriginalExtension();
                    $upload_file_path = public_path('uploads\videos').'\\'.$FileName;
                    move_uploaded_file( $_FILES['media']['tmp_name'], $upload_file_path);
                    $media_type = 2;
                    $new_name = $FileName;
                }else{
                    if (!file_exists(public_path('uploads/files'))) {
                        mkdir(public_path('uploads/files'),777, true);
                    }
                    $bytes = random_bytes(20);
                    $FileName = bin2hex($bytes).'.'.$RequestFile->getClientOriginalExtension();
                    $upload_file_path = public_path('uploads\files').'\\'.$FileName;
                    move_uploaded_file( $_FILES['media']['tmp_name'], $upload_file_path);
                    $media_type = 3;
                    $new_name = $FileName;
                }
            }else{
                if (in_array(strtolower($RequestFile->getClientOriginalExtension()), config('filemanager.IMAGE_EXT'))) {
                    $filePath = Storage::disk('public')->put('/media/images', $RequestFile);
                    $media_type = 1;
                }elseif (in_array(strtolower($RequestFile->getClientOriginalExtension()), config('filemanager.VIDEO_EXT'))) {
                    $filePath = Storage::disk('public')->put('/media/videos', $RequestFile);
                    $media_type = 2;
                }else{
                    $filePath = Storage::disk('public')->put('/media/files',$RequestFile);
                    $media_type = 3;
                }
                $new_name = basename($filePath);
            }



            $attrs = array(
                'filename' => $RequestFile->getClientOriginalName(),
                'extension' => $RequestFile->getClientOriginalExtension(),
                'size' => $RequestFile->getSize(),
            );

            $MediaModel = new LaravelFileManager();
            $MediaModel->file_path = $new_name;
            $MediaModel->media_type =$media_type;
            $MediaModel->is_active = isset($input['is_active'])? $input['is_active'] : 1;
            $MediaModel->attrs = serialize($attrs);
            $MediaModel->created_at = Carbon::now();
            $MediaModel->save();
            return ['status' => 2000, 'data' => $MediaModel->toArray(), 'msg' => 'successful'];

        } catch (Exception $e) {
            return ['status' => 5000, 'error' => $e->getMessage()];
        }
    }
    public function GetFileAll(Request $request)
    {
        $input = $request->all();
        try {
            $files = LaravelFileManager::where('is_active', 1)->get()->toArray();
            return ['status' => 2000, 'data' => $files, 'msg' => 'successful'];

        } catch (Exception $e) {
            return ['status' => 5000, 'error' => $e->getMessage()];
        }
    }
    public function GetFileSingle(Request $request, $file_id)
    {
        try {
            $file = LaravelFileManager::where('is_active', 1)->where('id', $file_id)->get()->first();
            if($file !== null){
                return ['status' => 2000, 'data' => $file, 'msg' => 'successful'];
            }
            return ['status' => 5000, 'msg' => 'data not found'];

        } catch (Exception $e) {
            return ['status' => 5000, 'error' => $e->getMessage()];
        }
    }
    public function DeleteFileSingle(Request $request, $file_id)
    {
        try {
            $file = LaravelFileManager::where('is_active', 1)->where('id', $file_id)->get()->first();
            if($file !== null){
                $file->is_active = 0;
                $file->update();
                return ['status' => 2000, 'msg' => 'successful'];
            }
            return ['status' => 5000, 'msg' => 'data not found'];
        } catch (Exception $e) {
            return ['status' => 5000, 'error' => $e->getMessage()];
        }
    }
    public function DeleteFileSingleHard(Request $request, $file_id)
    {
        try {
            $file = LaravelFileManager::where('id', $file_id)->get()->first();
            if($file !== null){
                LaravelFileManager::where('id', $file_id)->delete();
                return ['status' => 2000, 'msg' => 'successful'];
            }
            return ['status' => 5000, 'msg' => 'data not found'];
        } catch (Exception $e) {
            return ['status' => 5000, 'error' => $e->getMessage()];
        }
    }
}
