<?php
/**
 * Connection to database
 *
 * - host
 * - user
 * - password
 * - database name
 */

$__host = "localhost";
$__user = "root";
$__password = "";
$__dbname = "safe_demo";

$__conn = mysqli_connect($__host, $__user, $__password, $__dbname) or die("Error 610: A connection problem just occured. Please contact admin. ");



