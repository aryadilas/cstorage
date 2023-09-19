<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;

class FolderController extends Controller
{
    public function index(){
        $data = Folder::get();
        return view("index", ["data" => $data]);
    }

    public function store(Request $request){
        $data = [
            "name" => $request->name,
            "lang" => "PHP,JS,HTML,CSS"
        ];
        Folder::create($data);
        return redirect()->back();
    }

    public function delete($folderId){
        $data = Folder::where("id", $folderId)->delete();
        return redirect("/");
    }
}
