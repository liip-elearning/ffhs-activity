<?php

require_once("../../config.php");

$id = optional_param('id',0,PARAM_INT);    // Course Module ID, or
$l = optional_param('l',0,PARAM_INT);     // Label ID

if ($id) {
    $PAGE->set_url('/mod/ffhs/view.php', array('id'=>$id));
    if (! $cm = get_coursemodule_from_id('ffhs', $id)) {
        print_error('invalidcoursemodule');
    }

    if (! $course = $DB->get_record("course", array("id"=>$cm->course))) {
        print_error('coursemisconf');
    }

    if (! $ffhs = $DB->get_record("ffhs", array("id"=>$cm->instance))) {
        print_error('invalidcoursemodule');
    }

} else {
    $PAGE->set_url('/mod/ffhs/view.php', array('l'=>$l));
    if (! $ffhs = $DB->get_record("ffhs", array("id"=>$l))) {
        print_error('invalidcoursemodule');
    }
    if (! $course = $DB->get_record("course", array("id"=>$ffhs->course)) ){
        print_error('coursemisconf');
    }
    if (! $cm = get_coursemodule_from_instance("ffhs", $ffhs->id, $course->id)) {
        print_error('invalidcoursemodule');
    }
}

require_login($course, true, $cm);
echo $OUTPUT->header();
$renderer = $PAGE->get_renderer('mod_ffhs');
echo $renderer->display_ffhs($ffhs);
echo $OUTPUT->footer();
//redirect("$CFG->wwwroot/course/view.php?id=$course->id");