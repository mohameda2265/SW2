<?php
require('../../config.php');
require_once('locallib.php');
$PAGE->set_url( '/mod/attendance/viewex.php');
//$PAGE->set_context(get_system_context());
$PAGE->set_title("All Excuses");
$PAGE->set_heading("All Excuses");
global $USER;
$accept = optional_param( 'accept', 0, PARAM_INT );
$reject = optional_param( 'reject', 0, PARAM_INT );
$attendance_id =optional_param( 'attendance_id', 0, PARAM_INT );

echo $OUTPUT->header();
$my_excuses = get_excuses();


if ($accept and isset( $my_excuses[$accept] )) {


    $url='/mod/attendance/take.php?id='.$USER->id.'&sessionid='.$attendance_id.'&grouptype=0';

    redirect($url);


}

if ($reject and isset( $my_excuses[$reject] )) {

    $DB->delete_records( 'attendance_excuses', array (
        'id' => $reject
    ) );
    redirect ( $PAGE->url );


}


foreach ($my_excuses as $excuse) {

    $line = array ();

    // Student Name
    $line[0] = get_student_name($excuse->from_id);

    //Group Description
    $line[1] = $excuse->description;

    //Action Buttons
    $line[2] = $OUTPUT->single_button( new moodle_url( '/mod/attendance/viewex.php', array (
        'accept' => $excuse->id,
        'attendance_id'=> $excuse->attendance_id,
    ) ), 'Accept');
    $actionpresent = true;

    $line[3] = $OUTPUT->single_button( new moodle_url( '/mod/attendance/viewex.php', array (
        'reject' => $excuse->id,
    ) ), 'Reject');




    $data[] = $line;
}





$sortscript = file_get_contents( './lib/sorttable/sorttable.js' );
echo html_writer::script( $sortscript );
$table = new html_table();
$table->attributes = array (
    'class' => 'generaltable sortable invitations-table',
);
$table->head = array (
    'Student Name',
    'Description',
    'Action',''
);
if ($actionpresent) {
    array_push($table->head, $straction);
}

$table->data = $data;
echo html_writer::table( $table );

echo $OUTPUT->footer();