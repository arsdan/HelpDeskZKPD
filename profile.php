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
    include_once('./private/connection.php');
    include_once('./private/user.php');
    $conn = new Connection();
    $connect_db = $conn->open();
    var_dump($_GET['user_id']);
    $sql_select_users = "SELECT * FROM user_t WHERE user_id = ";
    $query_get_users = pg_query($connect_db,$sql_select_users);
    $user = new UserT;
    $row = pg_fetch_object($query_get_users)
    $user->setFullName($row->user_last_name .' '
        .$row->user_name.' '
        .$row->user_middle_name);
    $user->setPhone($row->user_phone);
    $user->setEmail($row->user_email);
    $user->setSection($row->user_section);
    $user->setCabinet($row->user_cabinet);
    foreach ($user->getUser() as $prop) {
        echo $prop.'<br>';
    }




    ?>
</body>
</html>