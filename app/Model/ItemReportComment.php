<?php

namespace App\Model;

/**
 * Class ItemReportComment
 * @package App\Model
 */
class ItemReportComment extends AbstractModel
{
    /**
     * @var string
     */
    protected $table = 'item_report_comments';

    /**
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'user_id',
        'report_id',
        'comment',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reportComment()
    {
        return $this->belongsTo(ItemReportComment::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function report()
    {
        return $this->belongsTo(ItemReport::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return ItemReportComment
     */
    public function getReportComment()
    {
        return $this->reportComment;
    }

    /**
     * @return ItemReport
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}