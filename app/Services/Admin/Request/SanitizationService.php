<?php

namespace App\Services\Admin\Request;

use HTMLPurifier;
use HTMLPurifier_Config;

class SanitizationService
{
    protected HTMLPurifier $purifier;

    public function __construct()
    {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.SafeIframe', true);
        $config->set('URI.AllowedSchemes', ['http' => true, 'https' => true, 'data' => true]);
        $config->set('HTML.Allowed', 'p[class],b,strong[class|style],i,em,u,ul,ol,li,a[href|target|rel|style],span[style|class],br,iframe[src|width|height|allowfullscreen|frameborder],img[src|alt|width|height],h1[class],h2[class],h3[class],h4[class],h5[class],h6[class],blockquote');
        $config->set('URI.SafeIframeRegexp', '%^(https?:)?//(www\.youtube\.com/embed/|player\.vimeo\.com/video/)[^"\']+$%');
        $config->set('CSS.AllowedProperties', ['color', 'font-weight', 'text-decoration', 'font-style']);
        $config->set('Attr.AllowedFrameTargets', ['_blank']);
        $config->set('HTML.DefinitionID', 'custom-def');
        $config->set('HTML.DefinitionRev', 1);
        $config->set('Cache.DefinitionImpl', null);

        if ($def = $config->maybeGetRawHTMLDefinition()) {
            $def->addAttribute('iframe', 'allowfullscreen', 'Bool');
            $def->addAttribute('p', 'class', 'Text');
            $def->addAttribute('span', 'class', 'Text');
            $def->addAttribute('span', 'style', 'Text');
            $def->addAttribute('div', 'class', 'Text');
            $def->addAttribute('strong', 'class', 'Text');
            $def->addAttribute('strong', 'style', 'Text');
            $def->addAttribute('blockquote', 'class', 'Text');
        }

        $this->purifier = new HTMLPurifier($config);
    }

    public function sanitizeRichText(string $html): string
    {
        $html = html_entity_decode($html);
    
        $html = preg_replace('/^(<p><br\s*\/?><\/p>)+$/i', '', $html);
        $html = str_replace('&nbsp;', '', $html);
    
        $hasVisualContent = preg_match('/<\s*(img|iframe)\b/i', $html);
    
        if (trim(strip_tags($html)) === '' && !$hasVisualContent) {
            return '';
        }
    
        $html = preg_replace_callback('/class="([^"]+)"/', function ($matches) {
            $allowed = array_filter(
                explode(' ', $matches[1]),
                fn($class) => str_starts_with($class, 'ql-')
            );
            return $allowed ? 'class="' . implode(' ', $allowed) . '"' : '';
        }, $html);
    
        return trim($this->purifier->purify($html));
    }
}
    