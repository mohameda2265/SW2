<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 15-Apr-18
 * Time: 9:37 PM
 */

class Absence
{
    public function get_absence_times(){
        global $DB, $USER;
        $user_id = $USER->id;
        $query = "SELECT *
FROM {attendance_log} l                           
JOIN {attendance_sessions} s
ON s.id = l.sessionid
WHERE s.attendanceid = 1 AND studentid = $user_id AND l.statusid = 6";
        $result = $DB->get_records_sql($query);
        return sizeof($result);
    }
    public function send_mail()
    {
        global $DB, $USER;
        mail("mohamed.fcih2265@gmail.com","Absence Warning","your absence is more than 2 times");
    }

}