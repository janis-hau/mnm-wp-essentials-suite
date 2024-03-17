<?php
// File Path: wordpress\wp-content\plugins\wp-base-plugin\includes\utilities\mnm-excerpts.php

// Check if the function mnm_get_excerpt doesn't already exist.
if (!function_exists('mnm_get_excerpt')) {

    /**
     * Generates an excerpt from the post content with a specified character or word limit.
     * 
     * @param int $limit The number of characters/words to limit the excerpt to.
     * @param bool $by_word If true, limit by words. If false, limit by characters.
     * @param string $ellipsis The text to append to the excerpt if it's trimmed.
     * @return string The generated excerpt.
     */
    function mnm_get_excerpt($limit, $by_word = true, $ellipsis = '...')
    {
        // Retrieve the current post's excerpt.
        $excerpt = get_the_excerpt();
        // Remove shortcodes from the excerpt.
        $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

        // Remove all HTML tags from the excerpt.
        $excerpt = strip_tags($excerpt);

        // Limit by words.
        if ($by_word) {
            // Split the excerpt into an array of words.
            $excerptArray = explode(' ', $excerpt, $limit + 1);
            // If the number of words exceeds the limit, trim the array and append ellipsis.
            if (count($excerptArray) > $limit) {
                array_pop($excerptArray);
                $excerpt = implode(" ", $excerptArray) . $ellipsis;
            } else {
                // Otherwise, just implode the array back into a string.
                $excerpt = implode(" ", $excerptArray);
            }
        } else {
            // Limit by characters.
            if (mb_strlen($excerpt) > $limit) {
                // If the excerpt is longer than the limit, trim it and append ellipsis.
                $excerpt = mb_substr($excerpt, 0, $limit - mb_strlen($ellipsis)) . $ellipsis;
            }
        }
        return $excerpt;
    }
}
