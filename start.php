<?php

require 'vendor/autoload.php';
require 'models/database.php';
require 'app/models/Paste.php';
require 'app/controllers/PasteController.php';
require 'config.php';



use Models\Database;
 
//Boot Database Connection
new Database();

