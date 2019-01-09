<?php

namespace App\Model;

/**
 * Class ItemReport
 * @package App\Model
 */
class ItemReport extends AbstractModel
{
    /**
     * @var string
     */
    public $table = 'item_reports';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'item_id',
        'status_id',
        'text',
        'location',
        'website',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(ItemReportStatus::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)
                ->select([
                        'id',
                        'uuid',
                        'item_report_banned',
                        'first_name',
                        'last_name',
                        'display_name'
                    ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * @return Item|null
     */
    public function getItem(): ?Item
    {
        return $this->item;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @return ItemReportStatus|null
     */
    public function getStatus(): ?ItemReportStatus
    {
        return $this->status;
    }
        
    public function photos()
    {
        return $this->hasMany('App\Model\ReportPhoto', 'report_id');
    }
}