<?php namespace SunLab\Newsletter\Classes;

interface NewsPluginInterface
{
    /**
     * Detect if a news plugin is installed
     *
     * @return bool
     */
    public static function detectPlugin();

    /**
     * Return a collection of categories
     * @return October\Rain\Support\Collection
     */
    public static function getNewsCategories();

    /**
     * Return a collection of news, limited to an age in days
     * @param integer $days
     * @return October\Rain\Support\Collection
     */
    public static function getPostsSince($days);

    /**
     * Return the array needed for the Subscriber->categories relationship
     * @return array
     */
    public static function getCategoryRelationship();
}
