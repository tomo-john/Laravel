<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;

class FolderController extends Controller
{
    /**
     *  【フォルダ作成ページの表示機能】
     *
     *  GET /folders/create
     *  @return \Illuminate\View\View
     */
    public function showCreateForm()
    {
        return view('folders/create');
    }


    /**
     *  【フォルダの作成機能】
     *  
     *  POST /folders/create
     *  @param Request $request （リクエストクラスの$request）
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $folder = new Folder();
        $folder->title = $request->title;
        $folder->save();

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }

}
