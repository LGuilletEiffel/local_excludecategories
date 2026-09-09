<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin administration pages are defined here.
 *
 * @package     local_excludecategories
 * @category    admin
 * @copyright   2022 Laurent Guillet <laurent.guillet@univ-eiffel.fr>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if (has_capability('local/excludecategories:configureplugin', context_system::instance())) {

    $listcategories = $DB->get_records('course_categories');

    $readablelistcategories = array();

    foreach ($listcategories as $category) {

        $readablelistcategories[$category->id] = "ID : $category->id, Nom : $category->name";
    }

    $settings = new admin_settingpage('local_excludecategories',
            get_string('pluginname', 'local_excludecategories'), 'local/excludecategories:configureplugin');

    $ADMIN->add('modules', $settings);

    $settings->add(new admin_setting_configmultiselect(
                    'excludecategories/excludedcategories',
                    get_string('pluginname', 'local_excludecategories'),
                    null,
                    null,
                    $readablelistcategories
    ));
}
