<?php
try {
    $dbh = new PDO("mysql:host=192.168.99.100:3306", 'root', 'tiger');
    $dbh->exec("CREATE DATABASE IF NOT EXISTS camagru;
            CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
            GRANT ALL ON `$db`.* TO '$user'@'localhost';
            FLUSH PRIVILEGES;") 
    or die(print_r($dbh->errorInfo(), true));

} catch (PDOException $e) {
    die("DB ERROR: ". $e->getMessage());
}
try {
    
     $db = new PDO(
         'mysql:host=192.168.99.100:3306;dbname=camagru',
        'camagru',
        'camagru'
    );
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    $sql = "DROP TABLE IF EXISTS comment";
    $db->exec($sql);
    echo("Destroyed comment table.\n");

    $sql = "DROP TABLE IF EXISTS likes";
    $db->exec($sql);
    echo("Destroyed likes table.\n");

    $sql = "DROP TABLE IF EXISTS pictures";
    $db->exec($sql);
    echo("Destroyed pictures table.\n");

    $sql = "DROP TABLE IF EXISTS users";
    $db->exec($sql);
    echo("Destroyed users table.\n");

    $sql = "CREATE TABLE IF NOT EXISTS users(
        id_user INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
        password VARCHAR( 255 ) NOT NULL,
        username VARCHAR( 50 ) NOT NULL, 
        name VARCHAR( 250 ),
        email VARCHAR( 150 ), 
        bio VARCHAR( 150 ), 
        location VARCHAR( 150 ), 
        active TINYINT( 1 ) NOT NULL DEFAULT 0
    );" ;
    $db->exec($sql);
    echo("Created users table.\n");

    $sql = "CREATE table IF NOT EXISTS pictures(
        id_pict INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
        user_id INT( 11 ) NOT NULL, 
        creation_time DATETIME DEFAULT NOW(),
        path VARCHAR( 250 ),
        title VARCHAR( 150 ),
        description VARCHAR( 1024 ), 
        FOREIGN KEY (user_id) REFERENCES users(id_user)
    );" ;
    $db->exec($sql);
    echo("Created pictures Table.\n");

    $sql = "CREATE table IF NOT EXISTS likes(
        pict_id INT( 11 ),
        likes_id INT( 11 ),
        liked_id INT( 11 ),
        FOREIGN KEY (pict_id) REFERENCES pictures(id_pict),
        FOREIGN KEY (likes_id) REFERENCES users(id_user),
        FOREIGN KEY (liked_id) REFERENCES users(id_user),
        CONSTRAINT PK_Person PRIMARY KEY (pict_id, likes_id, liked_id)
    );" ;
    $db->exec($sql);
    echo("Created pictures Likes.\n");

    $sql = "CREATE table IF NOT EXISTS comment(
        id_comment INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
        pict_id INT( 11 ),
        user_id INT( 11 ),
        content VARCHAR( 2048 ),
        created DATETIME DEFAULT NOW(),
        FOREIGN KEY (pict_id) REFERENCES pictures(id_pict),
        FOREIGN KEY (user_id) REFERENCES users(id_user)
    );" ;
    $db->exec($sql);
    echo("Created pictures Comment.\n");

} catch(PDOException $e) {
    echo $e->getMessage();//Remove or change message in production code
}
?>
