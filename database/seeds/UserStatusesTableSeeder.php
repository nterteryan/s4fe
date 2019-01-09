<?php

use Illuminate\Database\Seeder;

class UserStatusesTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $user_statuses = [
            [
                'id'            => 1, 
                'name'         => 'pending',
                'created_date'  => date('Y-m-d H:i:s')
            ],
            [
                'id'            => 2, 
                'name'         => 'compleaded',
                'created_date'  => date('Y-m-d H:i:s')
            ],
            [
                'id'            => 3, 
                'name'         => 'confirmed',
                'created_date'  => date('Y-m-d H:i:s')
            ],
        ];
        
        $ids = [];
        foreach ($user_statuses as $user_status)
        {
            $ids[] = $user_status['id'];
           if(!\App\Models\UserStatus::whereId($user_status['id'])->update($user_status))
               \App\Models\UserStatus::create($user_status);
        }
        \App\Models\UserStatus::whereNotIn('id' , $ids)->delete();
    }
}
