<?php
include_once('connection.php');
if(isset($_GET['ticket_id'] )){
	$conn = new Connection();
	$connect_db = $conn->open();
	$ticket_id = $_GET['ticket_id'];
	$status_name = $_GET['status_ticket_name'];
	var_dump($ticket_id.' ');
	$sql_set_status = "UPDATE tickets SET status_ticket_id = (SELECT status_ticket_id FROM status_tickets WHERE status_ticket_name = $1)
	WHERE status_ticket_id = (SELECT status_ticket_id FROM status_tickets WHERE status_ticket_name = $2) AND ticket_id = $3";
	// $new_status_name;
	switch ($status_name) {
		case 'Ожидает':
		$new_status_name = 'В работе';
		break;
		case 'В работе':
		$new_status_name = 'Готов';
		break;
	}
	$stmt = pg_prepare($connect_db, "my_query", $sql_set_status);
	$stmt = pg_execute($connect_db, "my_query", [$new_status_name, $status_name, $ticket_id]);

	var_dump($new_status_name);
	header('Location: index.php');
	exit();
}
else{
	echo 'sadsad';
}
?>