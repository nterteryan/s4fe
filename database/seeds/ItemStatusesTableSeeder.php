<?php

use Illuminate\Database\Seeder;

class ItemStatusesTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
	$item_statuses = [
            [
                'id'            => 1, 
                'name'         => 'stolen',
                'color'        => '#FFFF4E4E',
                'created_date'  => date('Y-m-d H:i:s')
            ],
            [
                'id'            => 2, 
                'name'         => 'lost',
                'color'        => '#FFF5A623',
                'created_date'  => date('Y-m-d H:i:s')
            ],
            [
                'id'            => 3,
                'name'         => 'available',
                'color'        => '#FF80C136',
                'created_date'  => date('Y-m-d H:i:s')
            ],
            [
                'id'            => 4,
                'name'         => 'aproved',
                'color'        => '#FF80C136',
                'created_date'  => date('Y-m-d H:i:s')
            ],
        ];
        $ids = [];
        foreach ($item_statuses as $item_status)
        {
            $ids[] = $item_status['id'];
           if(!\App\Model\ItemStatus::whereId($item_status['id'])->update($item_status))
               \App\Model\ItemStatus::create($item_status);
        }
        \App\Model\ItemStatus::whereNotIn('id' , $ids)->delete();
}
}
