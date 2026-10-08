# Changelog

All notable changes to this plugin are documented here. The format follows
[Keep a Changelog](https://keepachangelog.com/en/1.1.0/).

## [Unreleased]

### Added

- First version: room pack `vrroomenv_rooms` for the `vrroomenv` sub-plugin type of `mod_vrroom`
  (2026100804 or later), with 20 rooms in `rooms/<id>/` (`room.glb`, `preview.jpg`) and the manifest
  `environments.json` (schema `vrroom-envpack/1`).
- Small rooms: `kitchen` (`zonesize` 1.5) and `workshop` (`zonesize` 2.0) set `small: true`, with 2
  places for stations each.
- `space-hallway`: a spaceship corridor (CC BY 4.0).
- Credits for every room in `README.md`, `thirdpartylibs.xml` and the manifest; licence texts in
  `LICENSES/`.
- PHPUnit test of the pack's manifest, files, strings, credits, licence texts and small rooms.

### Removed

- `mission-control` (NASA mission control room, provenance unclear) and its usage note
  `LICENSES/NASA-media-guidelines.txt`. Activities that used it fall back to a plain hall, and
  teachers see a notice asking them to choose another room.
