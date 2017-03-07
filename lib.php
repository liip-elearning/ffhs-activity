<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

defined('MOODLE_INTERNAL') || die();

/**
 * @param string $feature FEATURE_xx constant for requested feature
 * @return mixed True if module supports feature, null if doesn't know
 */
function ffhs_supports($feature) {
    switch($feature) {
        case FEATURE_BACKUP_MOODLE2:          return true;

        default: return false;
    }
}

function ffhs_add_instance($ffhs, $mform = null) {
    global $DB, $CFG;

    $ffhs->timemodified = time();
	  $ffhs->testformat = $ffhs->test['format'];
	  $ffhs->test = $ffhs->test['text'];
    $ffhs->id = $DB->insert_record('ffhs', $ffhs);

    return $ffhs->id;
}

function ffhs_delete_instance($id) {
    global $DB;

    if (! $ffhs = $DB->get_record("ffhs", array("id"=>$id))) {
		return false;
    }

    $result = true;

    if (! $DB->delete_records("ffhs", array("id"=>$ffhs->id))) {
        $result = false;
    }

    return $result;
}

function ffhs_update_instance($ffhs) {
    global $DB;

	  $ffhs->testformat = $ffhs->test['format'];
	  $ffhs->test = $ffhs->test['text'];
    $ffhs->timemodified = time();
    $ffhs->id = $ffhs->instance;

    return $DB->update_record("ffhs", $ffhs);
}
