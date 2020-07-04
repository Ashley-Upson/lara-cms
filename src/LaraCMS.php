<?php

namespace AshleyUpson\LaraCMS;

use AshleyUpson\LaraCMS\Models\CustomRoute;
use AshleyUpson\LaraCMS\Models\Navigation;
use AshleyUpson\LaraCMS\Models\Page;
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

        if(Auth::check() == false || Auth::user()->is_admin == 0)
            $navbar->where('is_published', 1);

        return $navbar->get();
    }

    public static function getCustomRoutes()
    {
        $routes = CustomRoute::query();

        if(Auth::check() == false || Auth::user()->is_admin == 0)
            $routes = $routes->where('is_published', 1);

        return $routes->get();
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
         * @todo: Properly implement page types.
         */
        return [
            (object)[
                'label' => 'Standard',
                'value' => 'standard'
            ]
        ];
    }
}