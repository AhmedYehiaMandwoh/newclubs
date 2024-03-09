<?php

namespace App\Classes;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/**
 * used to get and set locale of the current session.
 * @author Omar Hossam EL-Din Kandil <okandil273@gmail.com>
 */
class Localization
{
    /**
     * will get the current language of the session
     * @return string $locale
     */
    public static function getLocale(): string
    {
        return App::getLocale();
    }

    public static function getAllLocales(): array
    {
        return [
            [
                'id' => 'ar', 'name' => __('base.ar'), 'img_src' => asset('/icons/flags/sa.png'),
                'url' => LaravelLocalization::getLocalizedURL('ar',null, [], true)
            ],
            [
                'id' => 'en', 'name' => __('base.en'), 'img_src' => asset('/icons/flags/usa.png'),
                'url' => LaravelLocalization::getLocalizedURL('en',null, [], true)
            ],
        ];
    }

    public static function getLocaleImageSrc(): string
    {
        return match (self::getLocale()) {
            'ar' => asset('/icons/flags/sa.png'),
            'en' => asset('/icons/flags/usa.png'),
        };
    }

    /**
     * will set the current language of the session
     * @param string $language
     * @return bool
     */
    public static function setLocale(string $language): bool
    {
        $language = match ($language) {
            'en' => 'en',
            '*' => '*',
            default => 'ar'
        };
        return App::setLocale($language) ?? true;
    }

    public static function getHtmlDirection(): string
    {
        return App::getLocale() == 'ar' ? 'rtl' : 'ltr';
    }

    public static function setLocaleHeader(string $locale = null): ?\Illuminate\Http\JsonResponse
    {
        if (!$locale) {
            $locale = request()->header('Content-Language');
            if (!$locale)
                return response()->json(['message' => Lang::get('auth.setHeaderLang')], 200);
        }

        self::setlocale($locale);
        return null;
    }
}
