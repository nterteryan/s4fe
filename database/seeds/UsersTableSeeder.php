<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
	$users = [
            [
                'id'                 => 1, 
                'type_id'            => 1,
                'status_id'          => 2,
                'item_report_banned' => 0,
                'first_name'         => 'Admin',
                'last_name'          => 'Admin',
                'email'              => 'admin@admin.com',
                'password'           => app('hash')->make('admin@admin.com1'),
                'created_date'       => date('Y-m-d H:i:s'),
                'updated_date'       => date('Y-m-d H:i:s')
            ],
            [
                'id'                 => 2, 
                'type_id'            => 1,
                'status_id'          => 2,
                'item_report_banned' => 0,
                'first_name'         => 'Vasya',
                'last_name'          => 'Pupkin',
                'email'              => 'vasya@pupkin.com',
                'password'           => app('hash')->make('vasya@pupkin.com1'),
                'created_date'       => date('Y-m-d H:i:s'),
                'updated_date'       => date('Y-m-d H:i:s')
            ],
            [
                'id'                 => 3, 
                'type_id'            => 1,
                'status_id'          => 2,
                'item_report_banned' => 0,
                'first_name'         => 'Vano',
                'last_name'          => 'Avchyan',
                'email'              => 'vano.a@theprojectdrivers.com',
                'password'           => app('hash')->make('vano.a@theprojectdrivers.com1'),
                'created_date'       => date('Y-m-d H:i:s'),
                'updated_date'       => date('Y-m-d H:i:s')
            ],
        ];
        foreach ($users as $user)
        {
           if(!\App\User::whereId($user['id'])->update($user))
               \App\User::create($user);
        }
}
}
