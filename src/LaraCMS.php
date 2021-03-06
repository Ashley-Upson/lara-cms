<?php

namespace LaraCMS;

use Illuminate\Support\Facades\Log;
use LaraCMS\Models\CustomRoute;
use LaraCMS\Models\Navigation;
use LaraCMS\Models\Page;
use LaraCMS\Models\UserData;
use Illuminate\Support\Facades\Auth;

class LaraCMS
{
    public static function getPageContent(Page $page)
    {
        return 'Facade worked!!!';
    }

    public static function renderPage(Page $page)
    {
        $data = [
            'page' => $page,
            'navbar' => self::getNavbar()
        ];

        return view('laracms::themes.default.pages.main', $data);
    }

    public static function getNavbar()
    {
        $navbar = Navigation::query()->where('navigation_id', null)->with('children')->orderBy('order');

        if(Auth::check() === false || self::userIsAdmin(Auth::user()->id) === false)
            $navbar->where('is_published', 1);

        return $navbar->get();
    }

    public static function getPublishedCustomRoutes()
    {
        try {
            return CustomRoute::where('is_published', 1)->get();
        } catch(\Exception $exception) {
            Log::warning('LaraCMS: Encountered an error while attempting to load published routes: ' . $exception->getMessage());

            return [];
        }
    }

    public static function getUnpublishedCustomRoutes()
    {
        try {
            return CustomRoute::where('is_published', 0)->get();
        } catch(\Exception $exception) {
            Log::warning('LaraCMS: Encountered an error while attempting to load published routes: ' . $exception->getMessage());

            return [];
        }
    }

    public static function attributeString($attributes)
    {
        $string = '';

        foreach($attributes as $attribute)
            $string .= ' ' . $attribute->attribute . '="' . $attribute->value . '"';

        return $string;
    }

    public static function getPageTypes()
    {
        /**
         * todo: Properly implement page types.
         */
        return [
            (object)[
                'label' => 'Standard',
                'value' => 'standard'
            ]
        ];
    }

    public static function getContentTypes()
    {
        return [
            'text',
            'paragraph',
            'html',
            'blade',
            'image',
            'table',
            'form',
            'link',
            'file',
            'image_carousel',
            'video'
        ];
    }

    public static function userIsAdmin($userID)
    {
        $data = UserData::where('user_id', $userID)->first();

        return $data->is_admin === true;
    }
}