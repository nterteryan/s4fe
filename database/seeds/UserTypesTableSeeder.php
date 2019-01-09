<?php

use Illuminate\Database\Seeder;

class UserTypesTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
	$user_types = [
            [
                'id'            => 1, 
                'name'         => 'common',
                'created_date'  => date('Y-m-d H:i:s')
            ],
            [
                'id'            => 2, 
                'name'         => 'company',
                'created_date'  => date('Y-m-d H:i:s')
            ],
        ];
        $ids = [];
        foreach ($user_types as $user_type)
        {
            $ids[] = $user_type['id'];
           if(!\App\Models\UserType::whereId($user_type['id'])->update($user_type))
               \App\Models\UserType::create($user_type);
        }
        \App\Models\UserType::whereNotIn('id' , $ids)->delete();
}
}
