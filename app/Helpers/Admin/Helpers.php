<?php

if (!function_exists('hoverTextClass')) {
    function hoverTextClass(string $hex, array &$hoverClasses): string {
        $hex = ltrim($hex, '#');
        $class = 'hover-text-' . substr($hex, 0, 6);
        if (!isset($hoverClasses[$class])) {
            $hoverClasses[$class] = ".{$class}:hover { color: #{$hex}; }";
        }
        return $class;
    }
}