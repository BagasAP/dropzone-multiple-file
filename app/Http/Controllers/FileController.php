<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
class FileController extends Controller
{
    //
    public function create()
    {
        //
        return view('create');
    }

     public function store(Request $request)

    {

        $this->validate($request, [

                'filename' => 'required',
                'filename.*' => 'mimes:doc,pdf,docx,zip'

        ]);
        
        
        if($request->hasfile('filename'))
         {

            foreach($request->file('filename') as $file)
            {
                $name=$file->getClientOriginalName();
                $file->move(public_path().'/files/', $name);  
                $data[] = $name;  
            }
         }

         $file= new File();
         $file->filename=json_encode($data);
         
        
        $file->save();

        return back()->with('success', 'Your files has been successfully added');
    }

    public function fileCreate()
    {
        return view('dropzone');
    }

    public function fileStore(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);
        
        $imageUpload = new File();
        $imageUpload->filename = $imageName;
        $imageUpload->save();
        return response()->json(['success'=>$imageName]);
    }

    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('filename');
        File::where('filename',$filename)->delete();
        $path=public_path().'/images/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;  
    }
}
