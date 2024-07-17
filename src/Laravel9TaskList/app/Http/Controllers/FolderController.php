<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Folder;
use App\Http\Requests\CreateFolder;
use App\Http\Requests\EditFolder;

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
        try {
            /** @var App\Models\User **/
            $user = Auth::user();
            $user->folders;

            return view('folders/create');

        } catch (\Throwable $e) {
            Log::error('Error FolderController in showCreateForm: ' . $e->getMessage());
        }
    }

    /**
     *  【フォルダの作成機能】
     *
     *  POST /folders/create
     *  @param CreateFolder $request （Requestクラスの機能は引き継がれる）
     *  @return \Illuminate\Http\RedirectResponse
     *  @var App\Http\Requests\CreateFolder
     */
    public function create(CreateFolder $request)
    {
        try {
            $folder = new Folder();
            $folder->title = $request->title;

            /** @var App\Models\User **/
            $user = Auth::user();
            $user->folders()->save($folder);

            return redirect()->route('tasks.index', [
                'folder' => $folder->id,
            ]);
        } catch (\Exception $e) {
            Log::error('Error FolderController in create: ' . $e->getMessage());
        }
    }

    /**
     *  【フォルダ編集ページの表示機能】
     *
     *  GET /folders/{folder}/edit
     *  @param Folder $folder
     *  @return \Illuminate\View\View
     */
    public function showEditForm(Folder $folder)
    {
        try {
            /** @var App\Models\User **/
            $user = Auth::user();
            $folder = $user->folders()->findOrFail($folder->id);

            return view('folders/edit', [
                'folder_id' => $folder->id,
                'folder_title' => $folder->title,
            ]);
        } catch (\Throwable $e) {
            Log::error('Error FolderController in showEditForm: ' . $e->getMessage());
        }
    }

    /**
     *  【フォルダの編集機能】
     *
     *  POST /folders/{folder}/edit
     *  @param Folder $folder
     *  @param EditTask $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Folder $folder, EditFolder $request)
    {
        try {
            /** @var App\Models\User **/
            $user = Auth::user();
            $folder = $user->folders()->findOrFail($folder->id);
            $folder->title = $request->title;
            $folder->save();

            return redirect()->route('tasks.index', [
                'folder' => $folder->id,
            ]);
        } catch (\Throwable $e) {
            Log::error('Error FolderController in edit: ' . $e->getMessage());
        }
    }

    /**
     *  【フォルダ削除ページの表示機能】
     *
     *  GET /folders/{folder}/delete
     *  @param Folder $folder
     *  @return \Illuminate\View\View
     */
    public function showDeleteForm(Folder $folder)
    {
        try {
            /** @var App\Models\User **/
            $user = Auth::user();
            $folder = $user->folders()->findOrFail($folder->id);

            return view('folders/delete', [
                'folder_id' => $folder->id,
                'folder_title' => $folder->title,
            ]);
        } catch (\Throwable $e) {
            Log::error('Error in showDeleteForm: ' . $e->getMessage());
        }
    }

    /**
     *  【フォルダの削除機能】
     *
     *  POST /folders/{folder}/delete
     *  @param Folder $folder
     *  @return RedirectResponse
     */
    public function delete(Folder $folder)
    {
        try {
            /** @var App\Models\User **/
            $user = Auth::user();
            $folder = $user->folders()->findOrFail($folder->id);

            $folder = DB::transaction(function () use ($folder) {
                if($folder) throw new \Exception('500');
                $folder->tasks()->delete();
                $folder->delete();
                return $folder;
            });

            $folder = Folder::first();

            return redirect()->route('tasks.index', [
                'folder' => $folder->id
            ]);
        } catch (\Throwable $e) {
            Log::error('Error FolderController in delete: ' . $e->getMessage());
        }
    }
}

