<?php
namespace App\Model;

use App\Models\AModel;

class ReportPhoto extends AbstractModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'report_id',
        'name',
        'file',
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_date','updated_date'
    ];
}
