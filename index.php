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

/**
 * Prediction models tool frontend.
 *
 * @package		tool_recovergrades
 * @copyright	2020 Mazitov Artem
 * @license		http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require __DIR__ . '/../../../config.php';
// require $CFG->libdir . '/adminlib.php';
// TODO del admin_externalpage_setup
// admin_externalpage_setup('tool_recovergrades', '', null, '', ['pagelayout' => 'report']);
$id = optional_param('id', 0, PARAM_INT);
$params = ['id' => $id];

$course = $DB->get_record('course', $params, '*', MUST_EXIST);
$context = context_course::instance($course->id, MUST_EXIST);
require_login($course);
$title = get_string('title', 'tool_recovergrades', $course->fullname);

$PAGE->set_url('/'.$CFG->admin.'/tool/recovergrades/index.php', $params);
$PAGE->set_pagelayout('course');
$PAGE->set_title($title);

echo $OUTPUT->header();
echo $OUTPUT->heading($title);

echo $OUTPUT->footer();