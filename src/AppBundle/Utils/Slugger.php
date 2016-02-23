<?php

namespace AppBundle\Utils;


class Slugger
{
    /**
     * @param string $str
     *
     * @return string
     */
    public function slugify($str)
    {
        // http://cubiq.org/the-perfect-php-clean-url-generator
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_| -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_| -]+/", '-', $clean);

        return $clean;
    }
}