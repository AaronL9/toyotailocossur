<?php

if (!function_exists('vite_asset')) {
  function vite_asset(string $entry): string
  {
    $manifestPath = FCPATH . 'assets/manifest.json';

    if (!file_exists($manifestPath)) {
      return "/assets/{$entry}";
    }

    $manifest = json_decode(file_get_contents($manifestPath), true);

    if (!isset($manifest[$entry])) {
      return "/assets/{$entry}";
    }

    return $manifest[$entry]['file'];
  }
}

if (!function_exists('vite_css')) {
  function vite_css(string $entry): string
  {
    $manifestPath = FCPATH . 'assets/manifest.json';

    if (!file_exists($manifestPath)) {
      return '';
    }

    $manifest = json_decode(file_get_contents($manifestPath), true);

    if (!isset($manifest[$entry]['css'])) {
      return '';
    }

    $links = "";
    foreach ($manifest[$entry]['css'] as $cssFile) {
      $links .= '<link rel="stylesheet" href="/' . $cssFile . '">' . PHP_EOL;
    }

    return $links;
  }
}
