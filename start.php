<?php
/**
 * The loader for the pastebee infrastructure.
 * 
 * Inspired by the tutorial
 *    https://code.tutsplus.com/tutorials/using-illuminate-database-with-eloquent-in-your-php-app-without-laravel--cms-27247
 *
 * @date    2018-07-05
 * @version 1.0.0
 **/

require 'vendor/autoload.php';
require 'models/database.php';
require 'app/models/Paste.php';
require 'app/controllers/PasteController.php';
require 'config.php';


use Models\Database;
 
// --------- Boot Database Connection ---------------------------
new Database();

