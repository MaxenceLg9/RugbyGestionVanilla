<?php

function Connect(){
    return new PDO("mysql:host=localhost;dbname=GestionRugby", "root", "");
}
