<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$hook['display_override'] = array(
        'class'    => 'ReplaceToken',
        'function' => 'replacePlaceholderCode',
        'filename' => 'ReplaceToken.php',
        'filepath' => 'hooks'
);
