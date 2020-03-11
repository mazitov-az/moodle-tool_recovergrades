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
 * Local lib code
 *
 * @package		tool_recovergrades
 * @copyright	2020 Mazitov Artem
 * @license		http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

/**
 * Adds a recycle bin link to the course admin menu.
 *
 * @param navigation_node $navigation The navigation node to extend
 * @param stdClass $course The course to object for the tool
 * @param context $context The context of the course
 * @return void|null return null if we don't want to display the node.
 */
function tool_recovergrades_extend_navigation_course(navigation_node $navigation, stdClass $course, context_course $context) {
    global $PAGE;
    // Only add this settings item on non-site course pages.
    // Check we can view
    if (!$PAGE->course || $PAGE->course->id == SITEID || !has_capability('tool/recovergrades:manage', $context)) {
        return null;
    }

    $url = new moodle_url('/admin/tool/recovergrades/index.php', ['id' => $course->id]);
    $pluginname = get_string('pluginname', 'tool_recovergrades');

    $node = navigation_node::create(
        $pluginname,
        $url,
        navigation_node::NODETYPE_LEAF,
        'tool_recovergrades',
        'tool_recovergrades',
        new pix_icon('i/reload', $pluginname)
    );

    if ($PAGE->url->compare($url, URL_MATCH_BASE)) {
        $node->make_active();
    }

    $navigation->add_node($node);
}