<?php

    class Connexion {

        private static $instance;

        private function __construct() {}
        
        public static function Connect() {
            if (!isset(self::$instance)) {
                try {
                    self::$instance = new PDO("pgsql:host=localhost;dbname=r301", "root", "");
                } catch (PDOException $e) {
                    die($e->getMessage());
                }
            }
            return self::$instance;
        }

        public static function Disconnect() {
            self::$instance = null;
        }
        
    }

?>