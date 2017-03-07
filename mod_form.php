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

defined('MOODLE_INTERNAL') || die;

require_once ($CFG->dirroot.'/course/moodleform_mod.php');

class mod_ffhs_mod_form extends moodleform_mod {

    function definition() {
				global $DB;

				$mform = $this->_form;
				//$name = $this->name;
				$name = "what";
				$text = $DB->get_field('ffhs', 'test', array('name'=>$name), $strictness=IGNORE_MISSING);

        $mform->addElement('header', 'generalhdr', get_string('general'));
				$mform->addElement('text', 'name', get_string('activityname', 'ffhs'));
				$mform->setType('name', PARAM_RAW);
				$mform->addElement('editor', 'test', get_string('activitytext', 'ffhs'),
						array('enable_filemanagement' => false))->setValue(array('text' => $text));
				$mform->setType('test', PARAM_RAW);

        $this->standard_coursemodule_elements();
        $this->add_action_buttons(true, false, null);
    }
}
