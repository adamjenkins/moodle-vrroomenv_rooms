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

namespace vrroomenv_rooms;

use mod_vrroom\local\scene\environment_registry;

/**
 * Checks the pack's own manifest, files, strings and credits.
 *
 * @package    vrroomenv_rooms
 * @category   test
 * @copyright  2026 Adam Jenkins <adam@wisecat.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
#[\PHPUnit\Framework\Attributes\CoversNothing]
final class manifest_test extends \advanced_testcase {
    /**
     * The pack's root directory.
     *
     * @return string
     */
    private function pack_dir(): string {
        return dirname(__DIR__);
    }

    /**
     * The rooms of the pack's environments.json, parsed and checked by mod_vrroom.
     *
     * @return array room id => raw manifest entry
     */
    private function rooms(): array {
        $dir = $this->pack_dir();
        $json = file_get_contents($dir . '/' . environment_registry::MANIFEST);
        $this->assertNotFalse($json, 'environments.json is missing.');
        $result = environment_registry::parse_manifest($json, 'rooms', $dir);
        $this->assertSame([], $result['errors'], 'environments.json has errors.');
        return $result['rooms'];
    }

    /**
     * The manifest parses without errors and lists at least one room.
     */
    public function test_manifest_is_valid(): void {
        $rooms = $this->rooms();
        $this->assertNotEmpty($rooms);
        $this->assertSame(array_keys($rooms), array_values(array_unique(array_keys($rooms))));
        $sorted = array_keys($rooms);
        sort($sorted, SORT_STRING);
        $this->assertSame($sorted, array_keys($rooms), 'Rooms must be sorted by id.');
    }

    /**
     * Every room name is a string of this pack.
     */
    public function test_room_names_exist(): void {
        $strings = get_string_manager();
        foreach ($this->rooms() as $id => $room) {
            $message = "Room {$id}: the string {$room['name']} is missing from lang/en/vrroomenv_rooms.php.";
            $this->assertTrue($strings->string_exists($room['name'], 'vrroomenv_rooms'), $message);
        }
    }

    /**
     * Every room's model and preview exist, and bytes is the model's size.
     */
    public function test_room_files_exist(): void {
        $dir = $this->pack_dir();
        foreach ($this->rooms() as $id => $room) {
            $model = $dir . '/' . $room['file'];
            $preview = $dir . '/' . $room['preview'];
            $this->assertFileExists($model, "Room {$id}: model missing.");
            $this->assertFileExists($preview, "Room {$id}: preview missing.");
            $this->assertSame((int)$room['bytes'], filesize($model), "Room {$id}: bytes does not match the model size.");
        }
    }

    /**
     * Every room has a row in the README credit table and a thirdpartylibs.xml entry.
     */
    public function test_room_credits_exist(): void {
        $dir = $this->pack_dir();
        $readme = file_get_contents($dir . '/README.md');
        $this->assertNotFalse($readme, 'README.md is missing.');
        $xml = simplexml_load_file($dir . '/thirdpartylibs.xml');
        $this->assertNotFalse($xml, 'thirdpartylibs.xml is missing or invalid.');
        $locations = [];
        foreach ($xml->library as $library) {
            $locations[] = trim((string)$library->location);
        }
        foreach (array_keys($this->rooms()) as $id) {
            // PCRE \x60 is a backtick: the id may be written as code in the table.
            $row = '/^\|\s*\x60?' . preg_quote($id, '/') . '\x60?\s*\|/m';
            $this->assertMatchesRegularExpression($row, $readme, "Room {$id}: no row in the README credit table.");
            $this->assertContains('rooms/' . $id, $locations, "Room {$id}: no library in thirdpartylibs.xml.");
        }
    }

    /**
     * Every room's licence has its text in LICENSES/, and every text there is used by a room.
     */
    public function test_licence_texts_exist(): void {
        $dir = $this->pack_dir();
        // Licence => file in LICENSES/. No public-domain text ships, so a PD room fails here.
        $files = [
            'CC0-1.0' => 'CC0-1.0.txt',
            'CC-BY-3.0' => 'CC-BY-3.0.txt',
            'CC-BY-4.0' => 'CC-BY-4.0.txt',
            'MPL-2.0' => 'MPL-2.0.txt',
        ];
        $used = [];
        foreach ($this->rooms() as $id => $room) {
            $licence = $room['licence'];
            $this->assertArrayHasKey($licence, $files, "Room {$id}: no licence text is shipped for {$licence}.");
            $this->assertFileExists($dir . '/LICENSES/' . $files[$licence], "Room {$id}: LICENSES/{$files[$licence]} is missing.");
            $used[$files[$licence]] = true;
        }
        $shipped = array_values(array_diff(scandir($dir . '/LICENSES'), ['.', '..']));
        foreach ($shipped as $file) {
            $this->assertArrayHasKey($file, $used, "LICENSES/{$file} is not used by any room.");
        }
    }

    /**
     * Every start point lies at least 0.5 m inside its room's bounds, and every anchor and exit lies inside them.
     *
     * The viewer keeps the player 0.3 m inside the bounds, so a start closer to an edge is moved before the first frame.
     */
    public function test_start_points_inside_bounds(): void {
        $margin = 0.5;
        $epsilon = 1e-9;
        foreach ($this->rooms() as $id => $room) {
            $min = $room['bounds']['min'];
            $max = $room['bounds']['max'];
            [$x, , $z] = $room['start']['position'];
            $edge = min($x - $min[0], $max[0] - $x, $z - $min[2], $max[2] - $z);
            $message = "Room {$id}: the start point is only {$edge} m inside the bounds (at least {$margin} m needed).";
            $this->assertGreaterThanOrEqual($margin - $epsilon, $edge, $message);
            $places = $room['anchors'];
            if (isset($room['exit'])) {
                $places[] = $room['exit'];
            }
            foreach ($places as $n => $place) {
                [$px, , $pz] = $place['position'];
                $inside = $px >= $min[0] - $epsilon && $px <= $max[0] + $epsilon
                    && $pz >= $min[2] - $epsilon && $pz <= $max[2] + $epsilon;
                $this->assertTrue($inside, "Room {$id}: place {$n} ({$px}, {$pz}) is outside the bounds.");
            }
        }
    }

    /**
     * Small rooms have 2 to 20 station places and smaller station areas; the kitchen and workshop are small.
     */
    public function test_small_rooms(): void {
        $rooms = $this->rooms();
        foreach ($rooms as $id => $room) {
            if (empty($room['small'])) {
                continue;
            }
            $count = count($room['anchors']);
            $this->assertGreaterThanOrEqual(environment_registry::MIN_ANCHORS_SMALL, $count, "Room {$id}: too few anchors.");
            $this->assertLessThanOrEqual(environment_registry::MAX_ANCHORS, $count, "Room {$id}: too many anchors.");
            $this->assertArrayHasKey('zonesize', $room, "Room {$id}: a small room needs a zonesize.");
            $this->assertLessThan(environment_registry::ZONE_SIZE, $room['zonesize'], "Room {$id}: zonesize is not below 3.");
        }
        foreach (['kitchen', 'workshop'] as $id) {
            if (isset($rooms[$id])) {
                $this->assertTrue($rooms[$id]['small'] ?? false, "Room {$id} must be a small room.");
            }
        }
    }
}
