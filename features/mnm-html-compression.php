<?php
// FILE PATH: wp-content\plugins\mnm-wp-essentials-suite\features\mnm-html-compression.php

// ********************************************************************************
// * #HTML Minify
// */
// class WP_HTML_Compression
// {
//     protected $compress_inline_css;
//     protected $compress_inline_js;
//     protected $remove_comments;
//     protected $info_comment;
//     protected $html;

//     public function __construct($html, $options = []) {
//         $this->compress_inline_css = $options['compress_inline_css'] ?? true;
//         $this->compress_inline_js  = $options['compress_inline_js']  ?? true;
//         $this->remove_comments     = $options['remove_comments']     ?? true;
//         $this->info_comment        = $options['info_comment']        ?? true;

//         mnm_pre_r($options);

//         if (!empty($html)) {
//             $this->parseHTML($html);
//         }
//     }

//     public function __toString()
//     {
//         return $this->html;
//     }

//     protected function minifyHTML($html)
//     {
//         $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
//         preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
//         $overriding = false;
//         $raw_tag = false;
//         $html = '';
//         foreach ($matches as $token) {
//             $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
//             $content = $token[0];
//             if (is_null($tag)) {
//                 if (!empty($token['script'])) {
//                     $strip = $this->compress_inline_js;
//                 } else if (!empty($token['style'])) {
//                     $strip = $this->compress_inline_css;
//                 } else if ($content == '<!--wp-html-compression no compression-->') {
//                     $overriding = !$overriding;
//                     continue;
//                 } else if ($this->remove_comments) {
//                     if (!$overriding && $raw_tag != 'textarea') {
//                         $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
//                     }
//                 }
//             } else {
//                 if ($tag == 'pre' || $tag == 'textarea') {
//                     $raw_tag = $tag;
//                 } else if ($tag == '/pre' || $tag == '/textarea') {
//                     $raw_tag = false;
//                 } else {
//                     if ($raw_tag || $overriding) {
//                         $strip = false;
//                     } else {
//                         $strip = true;
//                         $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
//                         $content = str_replace(' />', '/>', $content);
//                     }
//                 }
//             }
//             if ($strip) {
//                 $content = $this->removeWhiteSpace($content);
//             }
//             $html .= $content;
//         }
//         return $html;
//     }

//     public function parseHTML($html)
//     {
//         $this->html = $this->minifyHTML($html);
//         if ($this->info_comment) {
//             $this->html .= "\n" . $this->bottomComment($html, $this->html);
//         }
//     }

//     protected function removeWhiteSpace($str)
//     {
//         // Bereinige White Spaces im HTML-String
//         $str = str_replace("\t", ' ', $str);
//         $str = str_replace("\n", '', $str);
//         $str = str_replace("\r", '', $str);
//         while (stristr($str, '  ')) {
//             $str = str_replace('  ', ' ', $str);
//         }
//         return $str;
//     }

//     protected function bottomComment($raw, $compressed)
//     {
//         $raw = strlen($raw);
//         $compressed = strlen($compressed);
//         $savings = ($raw - $compressed) / $raw * 100;
//         $savings = round($savings, 2);
//         return '<!-- HTML Minify | https://my-new.me | Größe reduziert um ' . $savings . '% | Von ' . $raw . ' Bytes, auf ' . $compressed . ' Bytes -->';
//     }
// }

// function wp_html_compression_start() {
//     // Hole die Einstellungen für HTML Compression
//     $feature_settings = get_mnm_feature_setting('html_compression');

//     if ($feature_settings && $feature_settings['is_active']) {
//         $options = $feature_settings['settings'];

//         ob_start(function ($html) use ($options) {
//             $compression = new WP_HTML_Compression($html, $options);
//             return $compression->__toString();
//         });
//     }
// }

// // add_action('get_header', 'wp_html_compression_start');

// add_action('template_redirect', 'wp_html_compression_start', 0);


class WP_HTML_Compression
{
    protected $compress_html;
    protected $keep_whitespaces_between_tags;
    protected $compress_inline_css;
    protected $compress_inline_js;
    protected $remove_comments;
    protected $info_comment;
    protected $html;

    public function __construct($html, $options = [])
    {
        $this->compress_html = $options['is_active'] ?? false;
        $this->compress_inline_css = $options['compress_inline_css'] ?? false;
        $this->compress_inline_js = $options['compress_inline_js'] ?? false;
        $this->remove_comments = $options['remove_comments'] ?? false;
        $this->info_comment = $options['info_comment'] ?? false;
        $this->keep_whitespaces_between_tags = $options['keep_whitespaces_between_tags'] ?? false;

        if (!empty($html)) {
            $this->parseHTML($html);
        }
    }

    public function __toString()
    {
        return $this->html;
    }

    protected function minifyHTML($html)
    {
        $cssBlocks = [];
        $jsBlocks = [];

        // Extrahiere und ersetze CSS
        $html = preg_replace_callback('/<style\b[^<]*(?:(?!<\/style>)<[^<]*)*<\/style>/is', function ($matches) use (&$cssBlocks) {
            $id = uniqid('css_block_', true); // Generiere einen einzigartigen Identifier
            if ($this->compress_inline_css) {
                $cssBlocks[$id] = $this->compressCSS($matches[0]);
            } else {
                $cssBlocks[$id] = $matches[0];
            }
            return $id; // Verwende den Identifier als Platzhalter
        }, $html);

        // Extrahiere und ersetze JS
        $html = preg_replace_callback('/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/is', function ($matches) use (&$jsBlocks) {
            $id = uniqid('js_block_', true); // Generiere einen einzigartigen Identifier
            if ($this->compress_inline_js) {
                $jsBlocks[$id] = $this->compressJS($matches[0]);
            } else {
                $jsBlocks[$id] = $matches[0];
            }
            return $id; // Verwende den Identifier als Platzhalter
        }, $html);

        // Führe die allgemeine HTML-Bereinigung durch
        if ($this->compress_html) {
            $html = $this->removeWhiteSpace($html);
        }

        // Ersetze Platzhalter mit den gespeicherten Inhalten
        foreach ($cssBlocks as $id => $css) {
            $html = str_replace($id, $css, $html);
        }
        foreach ($jsBlocks as $id => $js) {
            $html = str_replace($id, $js, $html);
        }

        return $html;
    }

    protected function compressCSS($html)
    {
        // Suche nach allen <style>-Tags im HTML und komprimiere deren Inhalt
        return preg_replace_callback('/<style\b[^<]*(?:(?!<\/style>)<[^<]*)*<\/style>/is', function ($matches) {
            // Entferne White Spaces und Zeilenumbrüche innerhalb von <style>-Tags
            $css = preg_replace('/\s*{\s*/', '{', $matches[0]);
            $css = preg_replace('/;?\s*}\s*/', '}', $css);
            $css = preg_replace('/\s*;\s*/', ';', $css);
            return preg_replace('/\s+/', ' ', $css); // Reduziere alle übrigen White Spaces
        }, $html);
    }

    protected function compressJS($html)
    {
        return preg_replace_callback('/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/is', function ($matches) {
            // Entferne Zeilenkommentare
            $js = preg_replace('/\/\/[^\n]*\n/', "\n", $matches[0]);
            // Einfache Komprimierung: Entferne Zeilenumbrüche und reduziere White Spaces
            $js = preg_replace('/[\n\r]+/', '', $js);
            return preg_replace('/\s+/', ' ', $js); // Reduziere alle übrigen White Spaces
        }, $html);
    }

    protected function removeWhiteSpace($str)
    {
        // Bereinige White Spaces im gesamten HTML-String
        $str = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $str);
        if (!$this->keep_whitespaces_between_tags) {
            $str = preg_replace('/> </', '><', $str); // Entferne White Spaces zwischen HTML-Tags
        }
        return $str;
    }

    public function parseHTML($html)
    {
        $this->html = $this->minifyHTML($html);
        if ($this->info_comment) {
            $this->html .= "\n" . $this->bottomComment($html, $this->html);
        }
    }

    protected function bottomComment($raw, $compressed)
    {
        $raw = strlen($raw);
        $compressed = strlen($compressed);
        $savings = ($raw - $compressed) / $raw * 100;
        $savings = round($savings, 2);
        return '<!-- HTML Minify | https://my-new.me | Größe reduziert um ' . $savings . '% | Von ' . $raw . ' Bytes, auf ' . $compressed . ' Bytes -->';
    }
}

function wp_html_compression_start()
{
    $feature_settings = get_mnm_feature_setting('html_compression');

    if ($feature_settings) {
        $options = $feature_settings['settings'];

        ob_start(function ($html) use ($options) {
            $compression = new WP_HTML_Compression($html, $options);
            return $compression->__toString();
        });
    }
}

add_action('template_redirect', 'wp_html_compression_start', 0);
