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
    public function get_remarks(){
        global $DB, $USER;
        $user_id = $USER->id;
        $query = "SELECT *
FROM {attendance_log} l
WHERE l.sessionid = 1 AND studentid = $user_id AND l.statusid = 6";
        $result = $DB->get_records_sql($query);
        foreach ($result as $res){
            $remark=$res->remarks;
        }
        return $remark;
    }
    public function send_mail()
    {

        mail("mohamed.fcih2265@gmail.com","Absence Warning","your absence is more than 2 times");
    }

// Moved to locallib.php

//    function get_excuses(){
//        global $DB, $USER;
//        $user_id = $USER->id;
//        $query = "SELECT * FROM {attendance_excuse} WHERE to_id = ?";
//
//        $excuses = $DB->get_records_sql($query,array($user_id));
//        return $excuses;
//    }
//
//    function get_student_name($userid){
//        global $DB;
//        $query = "SELECT firstname,lastname FROM {user} WHERE id = ?";
//
//        $name = $DB->get_record_sql($query,array($userid));
//        $fullname = $name->firstname;
//        $fullname.=' '.$name->lastname;
//        return $fullname;
//    }

//    function get_attendances(){
//        global $DB;
//
//        $query = "SELECT id , description FROM {attendance_sessions}";
//        $query2 = "SELECT x.id, CONCAT(x.firstname, ' ', x.lastname) as fullname FROM {user} x JOIN {role_assignments} y ON y.userid = x.id WHERE y.roleid = ? OR y.roleid = ? OR y.roleid = ?";
//
//        $teachers = $DB->get_records_sql($query2,array('4','3','2'));
//
//        $rows = $DB->get_records_sql($query);
//        $select= "<form style='margin-left:100px;' method='post'><select name='select2'  >";
//        $select.= '  <option value="" selected disabled hidden>Select Attendance</option>';
//        foreach($rows as $row)
//        {
//            $select.='<option value="'.$row->id.'">'.$row->description.'</option>';
//
//        }
//        $select.='</select>';
//        $select.= "<select name='select1'>";
//        foreach($teachers as $teacher)
//        {
//            $select.='<option value="'.$teacher->id.'">'.$teacher->fullname.'</option>';
//
//        }
//        $select.='</select>';
//        $select.='<input type="text" name="desc" />
//                <input type="submit" name="sub" />';
//        $select.='</form>';
//
//        return $select;
//    }

}