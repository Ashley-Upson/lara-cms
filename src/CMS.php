<?php

namespace AshleyUpson\LaraCMS;

use AshleyUpson\LaraCMS\Models\CustomRoute;
use AshleyUpson\LaraCMS\Models\Navigation;
use AshleyUpson\LaraCMS\Models\Page;
use Illuminate\Support\Facades\Auth;

class CMS
{
    public function getPageContent(Page $page)
    {
        /**
         * @todo: Implement getPageContent on the CMS facade.
         */
        return 'Facade worked!!!';
    }

    public function renderPage(Page $page)
    {
        $data = [
            'page' => $page,
            'navbar' => self::getNavbar()
        ];

        return view('themes.default.pages.main', $data);
    }

    public function getNavbar()
    {
        $navbar = Navigation::query()->where('navigation_id', null)->with('children')->orderBy('order');

        if(Auth::check() == false || Auth::user()->is_admin == 0)
            $navbar->where('is_published', 1);

        return $navbar->get();
    }

    public function getCustomRoutes()
    {
        $routes = CustomRoute::query();

        if(Auth::check() == false || Auth::user()->is_admin == 0)
            $routes = $routes->where('is_published', 1);

        return $routes->get();
    }

    public function attributeString($attributes)
    {
        $string = '';

        foreach($attributes as $attribute)
            $string .= ' ' . $attribute->attribute . '="' . $attribute->value . '"';

        return $string;
    }

    public function getPageTypes()
    {
        /**
         * @todo: Properly implement page types.
         */
        return [
            (object)['label' => 'Standard', 'value' => 'standard']
        ];
    }
}