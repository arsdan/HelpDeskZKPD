<?php
//подключение к postgres
$connect_db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres");
if($connect_db){
	echo 'connect';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['insert_ticket'])) {
$sql_select_topics = 'select * from topic_tickets';
$query_get_topic = pg_query($connect_db, $sql_select_topics);
;
$sql_select_staff = '
select user_id, user_name, user_last_name
from user_t
where user_is_staff = true';
$query_get_staff = pg_query($connect_db, $sql_select_staff);

//Добавление тикета

    $ticket_client = 1; //нужно добавить авторизацию
  //$ticket_comment =
    $ticket_description = $_REQUEST['ticket_description'];
    while($row -> pg_fetch_object($query_get_staff)){
    	if($query_get_staff->user_name.$row->user_last_name == $_REQUEST['ticket_staff']){
    		$ticket_staff_id = $row->user_id;
    	}
    }
    echo $ticket_staff_id;
    while($row -> pg_fetch_object($query_get_topic)){
    	if($query_get_topic->topic_ticket_name == $_REQUEST['topics_ticket']){
    		$topic_ticket_id = $row->topic_ticket_id;
    	};
    }
    echo $topic_ticket_id;

    // $sql_insert_ticket = 'INSERT INTO tickets (ticket_description, topic_ticket_id, ticket_client, ticket_staff) VALUES (?,?,1,?)';
    // $stmt = $connect_db->prepare($sql_insert_ticket);
    //$stmt->bind_param('iii', $ticket_description, $topic_ticket_id, $ticket_staff_id);
    // $stmt->execute([$ticket_description, $topic_ticket_id, $ticket_staff_id]);
    $sql_insert_ticket = 'INSERT INTO tickets (ticket_description, topic_ticket_id, ticket_client, ticket_staff)
    VALUES (sqwqweqewrewtty,1,1,2)';
    pg_query($connect_db, $sql_insert_ticket);
    if($connect_db->query($sql_insert_ticket) === true){
    	echo 'добавлено';
    }
    else {
    	echo 'не добавлено';
    }
}
?>