<?php

namespace App\Http\Controllers\Backend\Hash;

use App\Models\Hash;
use Illuminate\Http\Request;
use App\Exports\HashesExport;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;

class HashController extends Controller
{
    //Hash Index Page
    public function hashIndex()
    {
        $allHash = Hash::select('id', 'name', 'short_code')->get();
        return view('backend.hash.hashIndex', compact('allHash'));
    }

    //Hash Store

    public function hashStore(Request $request)
    {
        $newHashData = $request->validate([
            'name' => 'required',
            'short_code' => 'required',
            'creation_date' => 'date',
            'hash' => 'required',
            'remark' => 'string'
        ]);
        Hash::create([
            'name' => $request->name,
            'short_code' => $request->short_code,
            'creation_date' => $request->creation_date,
            'hash' => Crypt::encryptString($request->hash),
            'remark' => $request->remark
        ]);

        return redirect()->route('admin.hash.index');
    }

    //Hash Show
    public function hashShow(Request $request, $id)
    {
        $hash = Hash::find($id);
        return view('backend.hash.hashShow', compact('hash'));
    }

    //Hash Delete Function
    public function hashDelete(Request $request, $id)
    {
        $hash = Hash::find($id);

        $hash->delete();

        return redirect()->route('admin.hash.index');
    }


    //Hash Export
    public function hashExport(Request $request)
    {
        $currentTime = Carbon::now('Asia/Dhaka')->toDayDateTimeString();
        return Excel::download(new HashesExport, $currentTime . '-users.xlsx');
    }
}
