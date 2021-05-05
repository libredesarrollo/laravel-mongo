<?php

namespace App\Http\Controllers\Dashboard;

use App\Event;
use App\File;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.calendar');
    }

    public function file(Request $request, Event $event)
    {


        $validator = Validator::make($request->all(),[
            'image' => "required|mimes:gif,jpg,jpeg,bmp,png|max:10240" //docx
        ]);

        if($validator->fails()){
            return response()->json(array("errors" => $validator->errors()),400);
        }

        $filename = time() . "." . $request->image->extension();

        $request->image->move(public_path("events"), $filename);

        $file = File::create(['file' => $filename]);

        //$event->files()->attach($file);
        $event->push('files', [
            'file' => $filename
        ]);

        return response()->json(array("file" => $filename));

    }
}
