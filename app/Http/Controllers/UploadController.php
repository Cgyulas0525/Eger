<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{

    public function store(Request $request) {

        if ($request->hasFile('image_url')) {

            $file = $request->file('image_url');
            $filename = $file->getClientOriginalName();
            $folder = uniqid('', true) . '-' . now()->timestamp;
            $file->storeAs('avatars/' . $folder, $filename);

            return $folder;

        }

        return '';
    }
}
