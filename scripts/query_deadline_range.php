<?php
$db = new PDO('sqlite:' . __DIR__ . '/../database/database.sqlite');
$sql = "select t.id,t.title,t.deadline,t.status,t.assigned_to,t.reminder_sent_at,u.name,u.email,u.deadline_reminder_emails from tasks t left join users u on u.id=t.assigned_to where t.deadline between date('now','-1 day') and date('now','+2 day') order by t.deadline";
foreach ($db->query($sql) as $row) {
    echo implode(' | ', $row) . PHP_EOL;
}
