# Changes

## Unreleased

- The museum entrance is no longer flat grey: stone walls, a terrazzo floor, marble columns and an oak gallery floor;
  a street and forecourt round it with its name over a new entrance; English signs a language teacher can use
  (opening times, admission prices, a floor guide, exhibit labels, visitor rules); a clock, a swinging pendulum, an
  ambient sound loop and an opening view. Its walk mesh and stations are unchanged.
- The cave can now be walked properly: a walk mesh over the cave floor and the hill outside, with a line of boulders
  where the walkable ground ends. It sits in a landscape instead of floating, has lanterns along the path, moving
  bats and trees, show-cave signs in English, an ambient sound loop and an opening view.
- Both rooms use the optional manifest keys `view`, `ambient` and `env` that newer VR room versions read; older
  versions ignore them.

## 0.1.2 (2026-11-15) — ALPHA

- The room pack is now listed on Packagist as `adamjenkins/moodle-vrroomenv_rooms`. Composer cannot install it yet: Moodle's Composer installer does not know the `vrroomenv` sub-plugin type, so install it by hand in `mod/vrroom/environment/rooms` (under `public/` on Moodle 5.1 and later) as before. No change to the plugin itself.
