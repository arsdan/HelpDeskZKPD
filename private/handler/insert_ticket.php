<?php
include_once '../connection.php';

if (isset($_POST['insert_ticket'])) {
  if (!empty($_POST['ticket_description']) && !empty($_POST['ticket_staff']) && !empty($_POST['topic_ticket'])) {
    $conn = new Connection();
    $connect_db = $conn->open();
  
  // SQL запросы
    $sql_select_topics = 'select * from topic_tickets';
    $query_get_topic = pg_query($connect_db, $sql_select_topics);
    $sql_select_staff = 'select user_id, user_name, user_last_name
    from user_t
    where user_is_staff = true';
    $query_get_staff = pg_query($connect_db, $sql_select_staff);

// Записываем id значений
    $ticket_client = 1; //добавить авторизацию
  //$ticket_comment = //добавить комментарий
    $ticket_description = $_REQUEST['ticket_description'];
    while($row = pg_fetch_object($query_get_staff)){
    	if($row->user_name.$row->user_last_name == $_REQUEST['ticket_staff']){
    		$ticket_staff_id = $row->user_id;
    	}
    }
    while($row = pg_fetch_object($query_get_topic)){
    	if($row->topic_ticket_name == $_REQUEST['topic_ticket']){
    		$topic_ticket_id = $row->topic_ticket_id;
    	}
    }

//Добавление тикета в бд
    $sql_insert_ticket = 'INSERT INTO tickets (ticket_description, topic_ticket_id, ticket_client, ticket_staff) VALUES ($1,$2,$3,$4)';
    $stmt = pg_prepare($connect_db, "my_query", $sql_insert_ticket);
    $stmt = pg_execute($connect_db, "my_query", [$ticket_description, $topic_ticket_id,1, $ticket_staff_id]);
    header('Location: ../../index.php');
    exit();
  }
  else {
    echo 'Пустые поля';
  }
}
else {
  echo 'Ошибка добавления';
}
?>