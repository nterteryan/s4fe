<?php

namespace App\Providers;

use App\Model\Category;
use App\Model\Item;
use App\Model\ItemPhoto;
use App\Model\ItemReport;
use App\Model\ItemReportComment;
use App\Repository\Category\CategoryEloquentRepository;
use App\Repository\Category\CategoryRepositoryInterface;
use App\Repository\Item\ItemEloquentRepository;
use App\Repository\Item\ItemRepositoryInterface;
use App\Repository\Item\Photo\ItemPhotoEloquentRepository;
use App\Repository\Item\Photo\ItemPhotoRepositoryInterface;
use App\Repository\Item\Report\Comment\ItemReportCommentEloquentRepository;
use App\Repository\Item\Report\Comment\ItemReportCommentRepositoryInterface;
use App\Repository\Item\Report\ItemReportEloquentRepository;
use App\Repository\Item\Report\ItemReportRepositoryInterface;
use App\Repository\User\UserEloquentRepository;
use App\Repository\User\UserRepositoryInterface;
use App\Model\User;
use Carbon\Laravel\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, function () {
            return new UserEloquentRepository(new User);
        });

        $this->app->bind(CategoryRepositoryInterface::class, function () {
            return new CategoryEloquentRepository(new Category);
        });

        $this->app->bind(ItemRepositoryInterface::class, function () {
            return new ItemEloquentRepository(new Item);
        });

        $this->app->bind(ItemPhotoRepositoryInterface::class, function () {
            return new ItemPhotoEloquentRepository(new ItemPhoto);
        });

        $this->app->bind(ItemReportRepositoryInterface::class, function () {
            return new ItemReportEloquentRepository(new ItemReport);
        });

        $this->app->bind(ItemReportCommentRepositoryInterface::class, function () {
            return new ItemReportCommentEloquentRepository(new ItemReportComment);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            UserEloquentRepository::class,
            CategoryEloquentRepository::class,
            ItemEloquentRepository::class,
            ItemPhotoEloquentRepository::class,
            ItemReportEloquentRepository::class,
            ItemReportCommentEloquentRepository::class
        ];
    }
}