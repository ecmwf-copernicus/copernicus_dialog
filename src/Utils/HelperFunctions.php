<?php

namespace Drupal\copernicus_dialog\Utils;

/**
 * Class HelperFunctions.
 */
class HelperFunctions {

  /**
   * Generate cookie ID from title
   *
   * @param string $title
   *   Title
   *
   * @return string
   *   Cookie ID
   */
  static public function generateCookieId($title) {

    $cookieId = 'copernicus_dialog_';
    $cookieId .= preg_replace('@[^a-z0-9_.]+@', '_', strtolower($title));

    return $cookieId;
  }
}
