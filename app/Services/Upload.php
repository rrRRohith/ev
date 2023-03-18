<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use \File;
use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;

trait Upload{

	protected $quality = 40;
	protected $encode = 'webp';

    /**
	 * Upload images received as base64.
     * @return string|null
	 */
    public function upload($input = null, $path = '/uploads/', $string = false) {

        $image = $string ? $input : request()->input($input);
		if(!$image || !preg_match('/data:image/', $image))
            return false;
        
        $image = str_replace('data:image/png;base64,', '', $image);
		$image = str_replace('data:image/webp;base64,', '', $image);
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $folder = \Carbon\Carbon::now()->format("Y/m/");
        File::isDirectory(public_path($path.$folder)) or File::makeDirectory(public_path($path.$folder), 0777, true, true);
        $file_name = $folder.time().rand().'.'.$this->encode;
        try{
            if(Image::make(base64_decode($image))->encode('webp', $this->quality)->save(public_path($path.$file_name )))
                return $file_name;
        }
        catch(\Exception $e){
            return false;
        }
    }
}