<?php
include_once('connection.php');
if(isset($_GET['ticket_id'] &&isset(&_GET['status_ticket_name']))){
	$conn = new Connection();
	$connect_db = $conn->open();
	$ticket_id = $_GET['ticket_id'];
	var_dump($ticket_id);
	$sql_set_status = "UPDATE tickets SET status_ticket_id = (SELECT status_ticket_id FROM status_tickets WHERE status_ticket_name = 'Ожидает')
	WHERE status_ticket_id = (SELECT status_ticket_id FROM status_tickets WHERE status_ticket_name = 'В работе');"
	$query_set_status
	$stmt = pg_prepare($connect_db, "my_query", $);
	$stmt = pg_execute($connect_db, "my_query", [$, $]);
	header('Location: index.php');
	exit();
}
else{
	echo 'sadsad';
}
?>