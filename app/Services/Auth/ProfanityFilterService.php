<?php

namespace App\Services\Auth;

class ProfanityFilterService 
{

    private static $patterns = [
        '/\W*n+\W*[i1!]+\W*g{2,}/i', # N-word
        '/\W*f+\W*[u]+\W*c+\W*k/i', # F-word
        '/[s5$]\W*\W*h+\W*[i1!]+\W*[t7]/i', # Shit
        # '/\W*d+\W*[i1!|a@]+\W*[c|m]+\W*[k|n]/i', # Dick / Damn
        '/\W*b+\W*[i1!]+\W*[t7]+\W*c+\W*h/i', # B-word
        # '/[a@]\W*[sS5$]{2,}/i', # Ass
        '/\W*c+\W*u+\W*n+\W*[t7]/i', # C-word
        '/\W*p+\W*u+\W*[s5$]{2,}/i', # P-word
        '/\W*c+\W*[o0]+\W*c+\W*k/i', # Co-word
    ];


    /**
     * Returns a boolean indicating whether this string matches
     * any of the regex profanty filters.
     *
     * @param [type] $string
     * @return void
     */
    public function matches($string)
    {
        foreach (self::$patterns AS $pattern) {

            if (preg_match($pattern, strtolower($string))) {
                return true;
            }

        }

        return false;
        
    }
}