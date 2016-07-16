<?php

require_once "helper.php";

session_start();

session_destroy();

redirect('index.php');