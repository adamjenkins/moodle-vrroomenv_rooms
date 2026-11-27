# Changelog

All notable changes to this plugin are documented here. The format follows
[Keep a Changelog](https://keepachangelog.com/en/1.1.0/).

## [Unreleased]

### Removed

- `ambient.mp3` and the manifest key `ambient` from `museum-entrance` and `cave` (owner, 2026-11-27: the synthesised
  loops sounded wrong; a room gets sound only from a real, licence-checked recording the owner has approved).

### Changed

- `walk.glb` of `atrium`, `lecture-theatre` and `meeting-room`: cut 0.3 m (the walker's body radius) back from every
  wall, railing and piece of furniture between knee and head height (room kit `packsafe.py`), so a walker's body
  can never stand overlapping a railing it cannot see.

## [0.2.0] - 2026-11-27

### Added

- Walk meshes (`walk.glb`) for `museum-entrance` (with a new staircase to the upper gallery), `lecture-theatre`,
  `atrium`, `meeting-room` and `cave`.
- `museum-entrance` and `cave`: signs in English, a clock (museum), animations (`loop:*`), a synthesised
  `ambient.mp3`, and the manifest keys `view`, `ambient` and `env`.

### Changed

- `museum-entrance` re-finished: stone walls, a terrazzo floor, marble columns, an oak gallery floor, a setting with a
  forecourt and an entrance. The geometry is unchanged, and the credit is extended.
- `cave`: land and hills round it, lanterns, a boundary of boulders at the end of the walkable ground, and the rock
  tinted warmer. The credit is extended.
- `$plugin->version` 2026112700, `$plugin->release` 0.2.0, dependency `mod_vrroom` 2026112700; Composer requires
  `adamjenkins/moodle-mod_vrroom` `^0.2`.

## [0.1.2] - 2026-11-15

### Added

- `composer.json` (package `adamjenkins/moodle-vrroomenv_rooms`, type `moodle-vrroomenv`, requiring `moodle/moodle` `>=5.2 <5.4` and `moodle/composer-installer` `^1.0`, plus `adamjenkins/moodle-mod_vrroom` `^0.1`) for installing from Packagist.

### Changed

- CI (`.github/workflows/ci.yml`) clones the public `mod_vrroom` repository without a token.

## [0.1.1] - 2026-10-11

### Added

- Camp listing screenshots with captions (`.camp/screenshots/`, `screenshots:` in `.camp/listing.yml`).
- `.gitattributes` with export-ignore rules (`.github`, `.gitattributes`, `.gitignore`, `.camp`,
  `tests`, `node_modules`), which camp's release workflow requires; v0.1.0 failed to publish to
  camp without it.

### Changed

- `$plugin->version` 2026101100, `$plugin->release` 0.1.1. No code changes.

## [0.1.0] - 2026-10-11

### Added

- camp registry listing (`.camp/listing.yml`) and release workflow
  (`.github/workflows/camp-release.yml`).
- First version: room pack `vrroomenv_rooms` for the `vrroomenv` sub-plugin type of `mod_vrroom`
  (2026100804 or later), with 20 rooms in `rooms/<id>/` (`room.glb`, `preview.jpg`) and the manifest
  `environments.json` (schema `vrroom-envpack/1`).
- Small rooms: `kitchen` (`zonesize` 1.5) and `workshop` (`zonesize` 2.0) set `small: true`, with 2
  places for stations each.
- `space-hallway`: a spaceship corridor (CC BY 4.0).
- Credits for every room in `README.md`, `thirdpartylibs.xml` and the manifest; licence texts in
  `LICENSES/`.
- PHPUnit test of the pack's manifest, files, strings, credits, licence texts and small rooms.
- GitHub Actions workflow (Moodle 5.3; PHP 8.3 + MariaDB 11.4, PHP 8.4 + PostgreSQL 17), installing
  `mod_vrroom` first.
- `tests/manifest_test.php`: every start point is at least 0.5 m inside its room's bounds, and every
  anchor and exit is inside them.

### Changed

- `kitchen`: a north wall, a west wall and a ceiling added (the source has walls on two sides only);
  start moved to (-1.8, 0.3). `workshop` start moved to (1.45, 0.62), facing 65, inside the 0.3 m
  walking margin and away from the first station; `lecture-theatre` start x 8.6 to 8.5.
  `$plugin->version` 2026100900 so browsers fetch the new files.

### Removed

- `mission-control` (NASA mission control room, provenance unclear) and its usage note
  `LICENSES/NASA-media-guidelines.txt`. Activities that used it fall back to a plain hall, and
  teachers see a notice asking them to choose another room.
