<?php

namespace App\Http\Controllers\Admin;

use App\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Transliterate;
use Session;
use File;


class UploadController extends Controller
{
    public function index()
    {
        $uploads = Upload::latest()->get();
        return view('admin.uploads.index', compact(['uploads']));
    }

    public function store(Request $request)
    {
        // валидация
        $this->validate($request, [
            'files' => 'required',
        ]);

        // сохранение изображений с кадрированием
        if ($request->has('files')){
            // сохраняем фото в папку на сервере и записываем в БД
            foreach ($request->file('files') as $file) {
                $fullname = $file->getClientOriginalName(); // имя файла с раширением abc.1.png
                $extension = $file->getClientOriginalExtension(); // расширение файла png
                $name = basename($fullname, '.' . $extension); // имя файла без раширением abc.1
                if(\strlen($name > 200)){
                    $name = \substr($name, 0, 200);
                }
                $suitable_name = Transliterate::make($name, ['type' => 'filename', 'lowercase' => true]); // имя файла в нормальном формате
                $new_name = $suitable_name . '_' . date('ymdHis') . '.' . $extension; // новое имя файла, которого нет на сервере

                $file->move(public_path() . '/uploads/', $new_name);
                $upload = new Upload();
                $upload->slug = '/uploads/' . $new_name;
                $upload->saveOrFail();
            }
        }

        Session::flash('msg', 'Файл сохранен');
        return redirect()->action('Admin\UploadController@index');
    }

    public function destroy($id)
    {
        $upload = Upload::findOrFail($id);

        // удалили с сервера
        File::delete(public_path($upload->slug));
        // удалили из БД
        $upload->delete();

        Session::flash('msg', 'Файл удален');
        return redirect()->action('Admin\UploadController@index');
    }
}
