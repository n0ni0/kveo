<?php

namespace AppBundle\Utils;
/**
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 */
class TermSplitter
{
    /**
     * Splits a given string into terms.
     *
     * @param string $string
     * @param int $minTermLength
     *
     * @return array
     */
    public function splitIntoTerms($string, $minTermLength = 2)
    {
        // Sanitizing the string: removes all non-alphanumeric characters except whitespaces
        $string = preg_replace('/[^[:alnum:] ]/', '', trim(preg_replace('/[[:space:]]+/', ' ', $string)));
        // Splits the string into terms and removes all terms which
        // length is less than $minTermLength
        $terms = array_unique(explode(' ', strtolower($string)));
        $terms = array_filter($terms, function($term) use ($minTermLength) {
            return $minTermLength <= strlen($term);
        });
        return $terms;
    }
}