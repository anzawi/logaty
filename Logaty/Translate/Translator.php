<?php

namespace PHPtricks\Logaty\Translate;

    use PHPtricks\Logaty\App;

/**
 * Class Translator
 */
class Translator
{
    /**
     * get translation from files
     * @param string $str
     * @param string $lang
     * @return string
     */
    public function getTranslate($str, $lang = '')
    {
        // check if language send and its enabled language or set language to default one.
        $lang = ($lang && in_array($lang, logaty()->enabled()) ?
            $lang :
            logaty()->current);

        // handel key to get translation from correct file
        /**
         * -remember- we store languages from directory (language/[language-code]/[page-key].php)
         * and inside file [page-key].php we have an array -> [ key => translation ]
         *
         * example :
         *      arabic language for home page
         *          translation file -> /languages/ar/home.php
         *          inside home.php -> [ 'welcome' => 'مرحبا بك في الصفحة الرئيسية لمكتبة لغاتي.' ]
         *
         *  to use it :
         *  1 - logaty('home.welcome');
         *  2 - logaty->__('home.welcome');
         *  3 - logaty->_x('home.welcome');
         */
        $target = explode('.', $str);
        // get translation file
                /*our language directory*/
        $file = logaty()->config->get('paths.lang_files') .
            /* language-key/page-key */
            "{$lang}/{$target[0]}.php";

        // check if file exists
        if(!file_exists($file))
        {
            return $str; // if translation file not exists just return given string
        }
        // get translation array from file
        $translation = include $file;
        unset($target[0]); // remove file name - we dont need file name language anymore

        // get the translation
        foreach ($target as $item)
        {
            if( isset($translation[$item]) ) {
                $translation = $translation[$item];
            }
        }

        // return translation if its a string otherwise return given string
        return is_string($translation) ? $translation : $str;
    }
}