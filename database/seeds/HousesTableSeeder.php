<?php

use Illuminate\Database\Seeder;

class HousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<22; $i++){
            DB::table('houses')->insert([
                'name' => 'Лигурия Вилла №'.$i,
                'capacity' => \rand(5, 20),
                'area' => \rand(100, 900).'.'.\rand(0, 99),
                'price' => \rand(500000, 6500000),
                'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ullamcorper dolor sed ex porta, vitae convallis tellus aliquet. Maecenas dictum, nisl eget placerat eleifend, eros dolor egestas dolor, nec pulvinar libero dolor a velit. Integer in condimentum magna, eu fermentum augue. Sed pharetra accumsan volutpat. Fusce accumsan, urna at eleifend elementum, nunc nisl malesuada libero, ac gravida neque libero vel lacus. Vestibulum nec lacus sit amet lacus finibus gravida ac ut dui. Praesent eu rhoncus neque.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ullamcorper dolor sed ex porta, vitae convallis tellus aliquet. Maecenas dictum, nisl eget placerat eleifend, eros dolor egestas dolor, nec pulvinar libero dolor a velit. Integer in condimentum magna, eu fermentum augue. Sed pharetra accumsan volutpat. Fusce accumsan, urna at eleifend elementum, nunc nisl malesuada libero, ac gravida neque libero vel lacus. Vestibulum nec lacus sit amet lacus finibus gravida ac ut dui. Praesent eu rhoncus neque.</p>',
                'display' => 1
            ]);
        }
    }
}
