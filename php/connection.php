<?php
/**
 * --------------------------------------------------
 * 
 * Adapted this from Sam Scott's connect.php
 * I only changed the dbname
 * Gord Bond, 000786196

 *Date Created: March 6, 2020
 *I, Gord Bond, 000786196 certify that this material is my original work. No other person's work 
 *has been used without due acknowledgement.
 * 
 */
try {
    $dbh = new PDO(
        "mysql:host=localhost;dbname=golf_tracker",
        "root",
        "root"
    );
} catch (Exception $e) {
    die("ERROR: Couldn't connect. {$e->getMessage()}");
}
?>