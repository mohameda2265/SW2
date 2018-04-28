<?php
require('../../config.php');
require_once('locallib.php');
$PAGE->set_url( '/mod/attendance/excuse.php');
//$PAGE->set_context(get_system_context());
$PAGE->set_title("Excuse");
$PAGE->set_heading("Excuse");
echo $OUTPUT->header();

if(isset($_POST['sub'])){

    $sessionid = $_POST['select2'];
    $desc = $_POST['desc'];
    $teacherid = $_POST['select1'];

       $newexcuse = ( object ) array (
            'from_id' => $USER->id,
            'to_id' => $teacherid,
            'attendance_id' => $sessionid,
            'description' => $desc,
        );
        $DB->insert_record( 'attendance_excuses', $newexcuse );
}

echo get_attendances();


echo $OUTPUT->footer();