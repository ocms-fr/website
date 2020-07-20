<?php namespace SunLab\Newsletter\Drivers;

use RainLab\Blog\Models\Category;
use RainLab\Blog\Models\Post;
use SunLab\Newsletter\Classes\NewsPluginDriverBase;
use SunLab\Newsletter\Classes\NewsPluginInterface;

class RainLabBlog extends NewsPluginDriverBase implements NewsPluginInterface
{
    public static function getPluginNamespace()
    {
        return 'RainLab\Blog';
    }

    public static function getNewsCategories()
    {
        return Category::all()->pluck('name', 'id');
    }

    public static function getPostsSince($days)
    {
        return Post::whereRaw("
                EXTRACT(DAY FROM AGE(CURRENT_TIMESTAMP, published_at))::INTEGER < ?
            ", [$days])->get();
    }

    public static function getCategoryRelationship()
    {
        return ['RainLab\Blog\Models\Category'];
    }
}
