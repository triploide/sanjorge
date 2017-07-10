<?php
require '../includes/config.php';
session_destroy();
header('location: login');
