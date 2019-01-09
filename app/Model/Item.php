<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class Item
 * @package App\Model
 * @author Varazdat Stepanyan
 */
class Item extends AbstractModel
{
    use FullTextWildcards;

    /**
     * @var string
     */
    protected $table = 'items';

    /**
     * @var array
     */
    protected $searchable = [
        'title',
        'description',
        'serial_number'
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'status_id',
        'transfer_ownership',
        'reward',
        'title',
        'description',
        'serial_number',
    ];

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
    public function transformOwnership()
    {
        return $this->belongsTo(User::class, 'transfer_ownership')
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
    public function status()
    {
        return $this->belongsTo(ItemStatus::class)
                ->select([
                        'id',
                        'name',
                    ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class)
                ->select([
                        'id',
                        'parent_id',
                        'name'
                    ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany(ItemPhoto::class)
                ->select([
                        'id',
                        'file',
                        'name'
                    ]);
    }

    /**
     * @return mixed
     */
    public function getTransferOwnership()
    {
        return $this->transformOwnership;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return Collection
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }
}