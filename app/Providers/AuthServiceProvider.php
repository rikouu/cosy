<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Models\Article::class  => \App\Policies\ArticlePolicy::class,
        \App\Models\Category::class => \App\Policies\CategoryPolicy::class,
        \App\Models\Comment::class  => \App\Policies\CommentPolicy::class,
        \App\Models\Menu::class     => \App\Policies\MenuPolicy::class,
        \App\Models\Tag::class      => \App\Policies\TagPolicy::class,
        \App\Models\User::class     => \App\Policies\UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
