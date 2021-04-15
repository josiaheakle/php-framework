<?php

use app\models\DBHandler;

abstract class Migration {
    use DBHandler;
    abstract public function up();
    abstract public function down();
}