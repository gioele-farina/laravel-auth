<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function uploadIcon(Request $request){

      $request -> validate([
        'upload-icon' => 'required|image|max:5000'
      ]);

      $img = $request -> file('upload-icon');
      $ext = $img -> getClientOriginalExtension();
      $name = rand(100000, 999999) . '_' . time();

      $fileName = $name . '.' . $ext;

      // Copia file in icons
      $img -> storeAs('icons', $fileName, 'public');

      // Salvo il nome del file nel db;

      $user = Auth::user();
      $user -> profile_icon = $fileName;
      $user -> save();

      return redirect() -> route('home');
    }

    public function deleteIcon(){
      $this-> fileDeleteUserIcon();

      $user = Auth::user();
      $user -> profile_icon = null;
      $user -> save();

      return redirect() -> route('home');
    }

    private function fileDeleteUserIcon(){
      $user = Auth::user();

      try {
        $fileName = $user -> profile_icon;
        $file = storage_path('app/public/icons/' . $fileName);
        File::delete($file);
      } catch (\Exception $e) {}

    }
}
