<?php

namespace App\Http\Controllers\Admin;

use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Transliterate;
use Session;
use File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::orderBy('priority')->get();
        return view('admin.sliders.index', compact(['sliders']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->action('Admin\SliderController@index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // валидация
        $this->validate($request, [
            'link' => 'sometimes|string|max:255',
            'priority' => 'sometimes|numeric|min:0|max:255',
            'image'  => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);

        // сохранение изображений с кадрированием
        if ($request->has('image')){
            // сохраняем фото в папку на сервере и записываем в БД
            $image = $request->file('image');
            $fullname = $image->getClientOriginalName(); // имя файла с раширением abc.1.png
            $extension = $image->getClientOriginalExtension(); // расширение файла png
            $name = basename($fullname, '.' . $extension); // имя файла без раширением abc.1
            if(\strlen($name > 200)){
                $name = \substr($name, 0, 200);
            }
            $suitable_name = Transliterate::make($name, ['type' => 'filename', 'lowercase' => true]); // имя файла в нормальном формате
            $new_name = $suitable_name . '_' . date('ymdHis') . '.' . $extension; // новое имя файла, которого нет на сервере

            \Image::make($image)->save(public_path('sliders_images/' . $new_name));

            // сохранение
            $slider = new Slider();
            $slider->priority =  $request->priority;
            $slider->link =  $request->link;
            $slider->slug = '/sliders_images/' . $new_name;
            $slider->saveOrFail();

            Session::flash('msg', 'Слайд сохранен');
            return redirect()->action('Admin\SliderController@index');
        } else {
            Session::flash('msg', 'Изображение не найдено');
            return redirect()->action('Admin\SliderController@index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // обновление приоритета картинки
        if($request->ajax()){

            // валидация
            $this->validate($request, [
                'priority' => 'required|numeric|min:0|max:255',

            ]);

            $slider = Slider::findOrFail($id);
            $slider->priority = $request->priority;
            $slider->saveOrFail();
            return response()->json([
                'status' => 'ok'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        // удалили с сервера
        File::delete(public_path($slider->url));
        // удалили из БД
        $slider->delete();

        Session::flash('msg', 'Изображение удалено');
        return redirect()->action('Admin\SliderController@index');
    }
}
