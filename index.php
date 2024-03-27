<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <title></title>
</head>
<body>
  <div class="ticket-list">
    <?php
    include('./private/connection.php');
//подключение к postgres
    $conn = new Connection();
    $connect_db = $conn->open();

//запрос для выводы тикетов
    $sql_select_tickets = 'SELECT client.user_name AS client_name,
    client.user_last_name AS client_last_name,
    client.user_section AS client_section,
    client.user_cabinet AS client_cabinet,
    tt.topic_ticket_name AS topic,
    st.status_ticket_id AS status_id,
    st.status_ticket_name AS status_name,
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
      <caption>Лист тикетов</caption>
      <tr>
        <th>Заказчик</th>
        <th>Отдел</th>
        <th>Кабинет</th>
        <th>Заголок</th>
        <th>Описание</th>
        <th>Исполнитель</th>
        <th>Дата создания</th>
        <th>Комментарий</th>
        <th>Статус</th>
      </tr>
      <?php
//вывод тикеток
      while ($row = pg_fetch_object($query_get_ticket)){
        ?>
        <tr>
          <td><?php echo $row->client_name.' '.$row->client_last_name; ?></td>
          <td><?php echo $row->client_section; ?></td>
          <td><?php echo $row->client_cabinet; ?></td>
          <td><?php echo $row->topic; ?></td>
          <td><?php echo $row->ticket_description; ?></td>
          <td><?php echo $row->staff_name.' '.$row->staff_last_name; ?></td>
          <td><?php echo $row->ticket_date_begin; ?></td>
          <td>
            <a href="private/handler/update_status_ticket.php?ticket_id=<?php echo $row->ticket_id; ?>&status_ticket_name=<?php echo $row->status_name?>">
              <?php echo $row->status_name?>
            </a>
          </td>
          <td><?php echo $row->ticket_comment; ?></td>
        </tr>
        <?php
      }
      ?>
    </table>
    <form action="private/handler/insert_ticket.php" method ="POST">

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

    <a href="view_user.php">Пользователь</a>
  </body>
  </html>