<?php

namespace App\Http\Controllers\Admin;

use App\House;
use App\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Transliterate;
use Session;
use File;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.houses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.houses.create');
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
            'name' => 'required|string|max:255',
            'capacity' => 'required|numeric|max:255',
            'area' => 'required|numeric',
            'price' => 'required|numeric|max:2147483647',
            'display' => 'sometimes', Rule::in(['1','0']),
            'description' => 'required|string|max:5000',
            'google_map' => 'sometimes|max:500',
            'images' => 'required',
            'images.*'  => 'image|mimes:jpeg,png,jpg,gif'
        ]);

        // сохранение основной части
        $house = new House();
        $house->name = $request->name;
        $house->capacity = $request->capacity;
        $house->area = $request->area;
        $house->price = $request->price;
        $house->display = $request->display ? 1 : 0;
        $house->description = $request->description;
        $house->google_map = $request->google_map;
        $house->saveOrFail();

        // сохранение изображений с кадрированием
        if ($request->has('images')){
            // сохраняем фото в папку на сервере и записываем в БД
            foreach ($request->file('images') as $image) {
                $fullname = $image->getClientOriginalName(); // имя файла с раширением abc.1.png
                $extension = $image->getClientOriginalExtension(); // расширение файла png
                $name = basename($fullname, '.' . $extension); // имя файла без раширением abc.1
                if(\strlen($name > 200)){
                    $name = \substr($name, 0, 200);
                }
                $suitable_name = Transliterate::make($name, ['type' => 'filename', 'lowercase' => true]); // имя файла в нормальном формате
                $new_name = $suitable_name . '_' . date('ymdHis') . '.' . $extension; // новое имя файла, которого нет на сервере

                // кадрирование по ширине с сохранением пропорций
                \Image::make($image)->save(public_path('houses_images/' . $new_name));

                $img = new Image();
                $img->house_id = $house->id;
                $img->slug = '/houses_images/' . $new_name;
                $img->saveOrFail();
            }
        }

        Session::flash('msg', 'Дом сохранен');
        return redirect()->action('Admin\HouseController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->action('Admin\HouseController@index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $house = House::findOrFail($id);
        return view('admin.houses.edit', compact(['house']));
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
        // обновление всего
        if($request->post() && !$request->ajax()) {
            // валидация
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'capacity' => 'required|numeric|max:255',
                'area' => 'required|numeric',
                'price' => 'required|numeric|max:2147483647',
                'display' => 'sometimes', Rule::in(['1', '0']),
                'description' => 'required|string|max:5000',
                'google_map' => 'sometimes|max:500',
                'images.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif'
            ]);

            // обновление основной части
            $house = House::findOrFail($id);
            $house->name = $request->name;
            $house->capacity = $request->capacity;
            $house->area = $request->area;
            $house->price = $request->price;
            $house->display = $request->display ? 1 : 0;
            $house->description = $request->description;
            $house->google_map = $request->google_map;
            $house->saveOrFail();

            // сохранение изображений с кадрированием
            if ($request->has('images')){
                // сохраняем фото в папку на сервере и записываем в БД
                foreach ($request->file('images') as $image) {
                    $fullname = $image->getClientOriginalName(); // имя файла с раширением abc.1.png
                    $extension = $image->getClientOriginalExtension(); // расширение файла png
                    $name = basename($fullname, '.' . $extension); // имя файла без раширением abc.1
                    if(\strlen($name > 200)){
                        $name = \substr($name, 0, 200);
                    }
                    $suitable_name = Transliterate::make($name, ['type' => 'filename', 'lowercase' => true]); // имя файла в нормальном формате
                    $new_name = $suitable_name . '_' . date('ymdHis') . '.' . $extension; // новое имя файла, которого нет на сервере

                    \Image::make($image)->save(public_path('houses_images/' . $new_name));

                    $img = new Image();
                    $img->house_id = $house->id;
                    $img->slug = '/houses_images/' . $new_name;
                    $img->saveOrFail();
                }
            }

            Session::flash('msg', 'Дом обновлен');
            return redirect()->action('Admin\HouseController@index');
        }

        // обновление приоритета картинки
        if($request->ajax()){

            // валидация
            $this->validate($request, [
                'image' => 'required|numeric',
                'priority' => 'required|numeric|min:0|max:255',

            ]);

            $img = Image::findOrFail($request->image);
            $img->priority = $request->priority;
            $img->saveOrFail();
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
    public function destroy(Request $request, $id)
    {
        $house = House::findOrFail($id);
        // удалить все данные (post)
        if($request->post() && !$request->ajax()){
            // удалить все изображения с сервера
            foreach ($house->images as $image){
                // удалять ли из бд ?
                File::delete(public_path($image->slug));
            }
            // удалили из БД
            $house->delete();
            Session::flash('msg', 'Дом удален');
            return redirect()->action('Admin\HouseController@index');
        }


        // удалить картинку (ajax)
        if($request->ajax()){
            // нашли изображение для удаления
            $image = $house->images->where('id', $request->image)->first();
            // удалили с сервера
            File::delete(public_path($image->slug));
            // удалили из БД
            $image->delete();

            return response()->json([
                'status' => 'ok',
            ]);
        }
    }
}
