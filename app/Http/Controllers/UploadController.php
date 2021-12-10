<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    //data[file,path,new_name,file_type,upload_type,delete_file]
    public static function  up($data=[])
    {
        //$new_name = $new_name === null ? time() : $new_name;
        if (request()->hasFile($data['file']) && $data['upload_type'] == 'single' ) {
            if (array_key_exists('delete_file', $data) && !empty($data['delete_file']) ) {
                Storage::has($data['delete_file'])? Storage::delete($data['delete_file']):'';
            }
            return request()->file($data['file'])->store($data['path']) ;
        }elseif (request()->hasFile($data['file']) && $data['upload_type'] == 'files' ) {

            $file = request()->file($data['file']);
            $size = $file->getSize();      
            $mime_type=$file->getMimeType();
            $name=$file->getClientOriginalName();
            $hash_name=$file->hashName();
            $file->store($data['path']);
            $add = File::create([
                'name'=>$name,
                'size'=>$size,
                'file'=>$hash_name,
                'path'=>$data['path'],
                'full_file'=>$data['path'].'/'.$hash_name,
                'mime_type'=>$mime_type,
                'file_type'=>$data['file_type'],
                'relation_id'=>$data['relation_id']
            ]);

            return $add->id;
        }
    }

    public function delete($id)
    {
        $file=File::find($id);
        if (!empty($file)) {
            Storage::delete($file->full_file);
            $file->delete();
        }
    }
}
