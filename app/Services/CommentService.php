<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Support\Facades\Storage;

class CommentService {

    public function store($request, int $comment_id){
        $path = Storage::disk('public')->put('file', $request->file);
        File::create([
            'comment_id' => $comment_id,
            'file_name' => $request->file->getClientOriginalName(),
            'path' => $path,
            
        ]);        
    }

    
}
