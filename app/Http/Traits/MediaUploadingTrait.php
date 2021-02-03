<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;

trait MediaUploadingTrait
{
    public function storeMedia(Request $request)
    {
        // Validates file size
        if (request()->has('size')) {
            $this->validate(request(), [
                'file' => 'max:' . request()->input('size') * 1024,
            ]);
        }

        // If width or height is preset - we are validating it as an image
        if (request()->has('width') || request()->has('height')) {
            $this->validate(request(), [
                'file' => sprintf(
                    'image|dimensions:max_width=%s,max_height=%s',
                    request()->input('width', 100000),
                    request()->input('height', 100000)
                ),
            ]);
        }

        // Request to Remove file
        if (request('action') == 'delete') {
            unlink(request('name'));
            // exit;
            return response()->json([
                'name' => request('name')
            ]);
        }

        // $path = storage_path('tmp/uploads');

        // try {
        //     if (!file_exists($path)) {
        //         mkdir($path, 0755, true);
        //     }
        // } catch (\Exception $e) {
        // }

        $file = $request->file('file');

        $name = uniqid() .'.'. trim($file->getClientOriginalExtension());

        // $file->move($path, $name);
        $dir = $file->storeAs(request('path'), $name, 'public');
        $name = 'storage/'.$dir;
        
        return response()->json([
            'name' => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
}
