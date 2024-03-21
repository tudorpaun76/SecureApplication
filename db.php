<?php
$db = new PDO('sqlite:blog.db');
$db->exec('CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, username TEXT, password TEXT, isAdmin INTEGER DEFAULT 0)');
$db->exec('CREATE TABLE IF NOT EXISTS posts (id INTEGER PRIMARY KEY, title TEXT, content TEXT, author TEXT)');
?>


