<?php

/*
 * --------------------------------------------------------------------
 * CodeIgniter 4 Front Controller
 * --------------------------------------------------------------------
 * This file serves as the front controller for CodeIgniter 4 when
 * the application is accessed from the root directory instead of
 * the public folder.
 */

// Redirect all requests to the public folder
require_once __DIR__ . '/public/index.php';