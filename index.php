<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <title></title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="ticket-list">
    <?php
//подключение к postgres
    $connect_db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres");
    if($connect_db){
      echo 'connect';
    }
//запрос для выводы тикетов
    $sql_select_tickets = 'SELECT client.user_name AS client_name,
    client.user_last_name AS client_last_name,
    client.user_section AS client_section,
    client.user_cabinet AS client_cabinet,
    tt.topic_ticket_name AS topic,
    st.status_ticket_name AS status,
    staff.user_name AS staff_name,
    staff.user_last_name AS staff_last_name,
    ticket_id,
    ticket_date_begin,
    ticket_date_end,
    ticket_comment,
    ticket_description
    FROM ((((tickets t
     LEFT JOIN user_t client ON t.ticket_client = client.user_id)
    LEFT JOIN user_t staff ON t.ticket_staff = staff.user_id)
    LEFT JOIN topic_tickets tt ON t.topic_ticket_id = tt.topic_ticket_id)
    LEFT JOIN status_tickets st ON t.status_ticket_id = st.status_ticket_id)';

    $query_get_ticket = pg_query($connect_db, $sql_select_tickets);
    ?>

    <table>
      <caption>лист тикетов</caption>
      <tr>
        <th>заказчик</th>
        <th>отдел</th>
        <th>кабинет</th>
        <th>заголок</th>
        <th>описание</th>
        <th>исполнитель</th>
        <th>дата создания</th>
        <th>комментарий</th>
        <th>статус</th>
      </tr>
      <form action="" method="POST">
      <?php
//вывод тикеток
      while ($row = pg_fetch_object($query_get_ticket)){
      $status_ticket_count = [
        $row->ticket_id => [
          'status_ticket_name' => $row->status,
          'status_ticket_count' => 0,

        ],
      ];
        echo '<tr>
        <td>'.$row->client_name.' '.$row->client_last_name.'</td>
        <td>'.$row->client_section.'</td>
        <td>'.$row->client_cabinet.'</td>
        <td>'.$row->topic.'</td>
        <td>'.$row->ticket_description.'</td>
        <td>'.$row->staff_name.' '.$row->staff_last_name.'</td>
        <td>'.$row->ticket_date_begin.'</td>
        <td>'.$row->ticket_comment.'</td>
        <td>
        <a href="javascript:changeTicketStatus('.$row->ticket_id.')">
        <input id="'.$row->ticket_id.'"name="status_ticket_name" type="submit" value="'.$row->status.'"/></td>
        </a>
        </tr>';
      }

      ?>
      </form>
      </table>
      <form action="ticket.php" method ="POST">

        <label>Заголовок</label>
        <input list="topics" type="text" name="topic_ticket" placeholder=""/>
          <datalist id="topics">
            <?php
            $sql_select_topics = 'select * from topic_tickets';
            $query_get_topic = pg_query($connect_db, $sql_select_topics);
            while($row = pg_fetch_object($query_get_topic)){
              echo '<option value = '.$row->topic_ticket_name.'>';
            }
            ?>
          </datalist>

        <label>Описание</label>
        <input type="text" name="ticket_description" placeholder="">

        <label>Исполнитель</label>
        <input list="staffs" type="text" name="ticket_staff" placeholder="">
          <datalist id="staffs">
            <?php
            $sql_select_staff = '
            select user_id, user_name, user_last_name
            from user_t
            where user_is_staff = true';
            $query_get_staff = pg_query($connect_db, $sql_select_staff);
            while($row = pg_fetch_object($query_get_staff)){
              echo'<option value ='.$row->user_name.$row->user_last_name.'>';
            }
            ?>
          </datalist>
        <br>
        <input type="submit" name="insert_ticket" value = "test"/>
    </form>
  </div>
</body>
<script type="text/javascript">
  function changeStatusTicket(ticket_id) {
    let statusTicketInput = document.getElementById('ticket_id');
  }
</script>
</html>