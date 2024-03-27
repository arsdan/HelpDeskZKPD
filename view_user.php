<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <title></title>
</head>
<body>
    <label>Страница пользователя</label>
    <br>
    <?php
        include('./private/connection.php');
        $conn = new Connection();
        $connect_db = $conn->open();
        $sql_select_users = 'SELECT * FROM user_t';
        $query_get_users = pg_query($connect_db,$sql_select_users);
        while($row = pg_fetch_object($query_get_users)){
            ?>
            <a href="profile.php?user_id = <?php echo $row->user_id ?>">
            <?php echo $row->user_name .'<br>';?>
            </a>
            <?php
        }


    ?>
</body>
</html>