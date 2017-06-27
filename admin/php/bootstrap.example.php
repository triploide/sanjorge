<?php
require_once(dirname(__FILE__) . '/lib/vendor/doctrine/Doctrine.php');
spl_autoload_register(array('Doctrine', 'autoload'));
$manager = Doctrine_Manager::getInstance();
$manager->setAttribute(Doctrine_Core::ATTR_AUTO_ACCESSOR_OVERRIDE, true);
$manager->setAttribute(Doctrine_Core::ATTR_AUTOLOAD_TABLE_CLASSES, true);
$conn = Doctrine_Manager::connection('mysql://USER:PASS@HOST/BASE','BASE');
$conn->setCollate('utf8_general_ci');
$conn->setCharset('utf8');
Doctrine_Core::loadModels(dirname(__FILE__) .'/models');
define('BOOTSTRAP', true);
