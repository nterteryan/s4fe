<?php

use Illuminate\Database\Seeder;

class ReportStatusesTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
	$report_statuses = [
            [
                'id'            => 1, 
                'name'          => 'pending',
                'created_date'  => date('Y-m-d H:i:s')
            ],
            [
                'id'            => 2, 
                'name'         => 'approved',
                'created_date'  => date('Y-m-d H:i:s')
            ],
            [
                'id'            => 3, 
                'name'         => 'rejected',
                'created_date'  => date('Y-m-d H:i:s')
            ],
        ];
        $ids = [];
        foreach ($report_statuses as $report_status)
        {
            $ids[] = $report_status['id'];
           if(!\App\Models\ItemReportStatus::whereId($report_status['id'])->update($report_status))
               \App\Models\ItemReportStatus::create($report_status);
        }
        \App\Models\ItemReportStatus::whereNotIn('id' , $ids)->delete();
}
}
