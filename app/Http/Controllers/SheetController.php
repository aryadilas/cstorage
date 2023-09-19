<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sheet;
use App\Models\Folder;

class SheetController extends Controller
{
    public function show($folderId){
        $data = Sheet::where("folder_id", $folderId)->orderBy("order_position")->get();
        // dd($data);
        $folder = Folder::where("id", $folderId)->first();
        
        return view("cheat", ["data" => $data, "folder" => $folder]);
    }

    public function getData($sheetId){
        $data = Sheet::where('id', $sheetId)->first();

        return response()->json($data);
    }

    public function update($sheetId, Request $request){
        $data = [
            "title" => $request->title,
            "code" => $request->code,
            "description" => $request->description,
            "language" => $request->language
        ];
        $sheet = Sheet::where('id', $sheetId)->first();
        $sheet->update($data);
        return redirect()->back();
    }

    public function store($folderId, Request $request){
        
        $data = [
            "folder_id" => $folderId,
            "title" => $request->title,
            "code" => $request->code,
            "description" => $request->description,
            "language" => $request->language
        ];
        //dd($data);
        Sheet::create($data);
        return redirect()->back();
    }

    public function delete($folderId){
        $data = Sheet::where("id", $folderId)->delete();
        return redirect()->back();
    }
}
