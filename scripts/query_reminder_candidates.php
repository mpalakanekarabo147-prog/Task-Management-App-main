<?php
$db = new PDO('sqlite:' . __DIR__ . '/../database/database.sqlite');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$sql = "select t.id as task_id,t.title,t.deadline,t.status,t.assigned_to,t.reminder_sent_at,u.id as user_id,u.name,u.email,u.deadline_reminder_emails from tasks t left join users u on u.id=t.assigned_to where t.deadline=date('now','+1 day') and t.status in ('pending','in_progress')";
foreach ($db->query($sql) as $row) {
    echo implode(' | ', $row) . PHP_EOL;
}
