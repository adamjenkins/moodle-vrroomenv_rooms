# VR room bundled rooms (`vrroomenv_rooms`)

A room pack for the VR room activity (`mod_vrroom`): 18 ready-made 3D rooms (classrooms, a theatre
theatre, a museum, homes, workplaces, outdoor places and science-fiction rooms) that teachers can
use instead of the simple built-in rooms. Each room comes with a starting point, the area students
can walk in, and 4 to 20 places where the activity puts its stations.

The rooms come from freely licensed sources. Each keeps its own licence and credit: see
[Credits](#credits).

This pack is not published on the Moodle Plugins directory.

## Requirements

- Moodle 5.2 or 5.3 (`$plugin->supported = [502, 503]`).
- `mod_vrroom` version 2026100802 or later (the version that adds the `vrroomenv` room-pack
  sub-plugin type).
- A browser with WebGL to see the rooms in 3D. The list view of an activity does not need them.

## Installation

1. Copy this repository to `public/mod/vrroom/environment/rooms` in your Moodle code.
2. Visit *Site administration > Notifications* to install it.

If you update `mod_vrroom` by replacing its folder, keep (or copy back) `environment/rooms`.
Uninstalling the pack is allowed at any time: activities that use its rooms then show a plain hall
instead, and teachers see a notice asking for the pack or another room.

## Using the rooms

- **Activity form**: the room list of the *Gallery walk*, *Escape chain* and *Empty room* templates
  shows the simple built-in rooms first, then the rooms of this pack grouped by kind (schools and
  learning, museums and galleries, work and shops, homes, historic places, outdoors, science
  fiction). The number of stations a room can hold is its number of station places.
- **Room editor**: the environment list of the room editor offers the same rooms.
- **Credits**: the activity page lists the credit of every room the activity uses, as the room's
  licence requires.

## Files

| Path | Content |
|---|---|
| `environments.json` | The manifest (schema `vrroom-envpack/1`): for each room its name string, category, files, size, licence, credit line, source, starting point, walking bounds, station places, optional exit, sky colour and lights. |
| `rooms/<id>/room.glb` | The room (glTF binary, at most 5 MB and 150,000 triangles, textures WebP). |
| `rooms/<id>/preview.jpg` | A 640 × 360 view from the starting point. |
| `lang/en/vrroomenv_rooms.php` | Room names. |
| `LICENSES/` | Licence texts of the rooms' licences. |
| `thirdpartylibs.xml` | One entry per room, for Moodle's third-party library report. |

The files are served to logged-in users by `mod_vrroom`'s `envfile.php`, only when they are named in
the manifest.

## Licence

- **Code** (`version.php`, `lang/`, `classes/`, `tests/`): GNU GPL v3 or later; see `LICENSE`.
- **Rooms** (`rooms/<id>/`): each room is under its own licence, listed in the credit table below,
  in `environments.json` and in `thirdpartylibs.xml`. Full texts are in `LICENSES/`:

| File | Licence | Fetched from (2026-10-08) |
|---|---|---|
| `LICENSES/CC0-1.0.txt` | Creative Commons CC0 1.0 Universal | https://creativecommons.org/publicdomain/zero/1.0/legalcode.txt |
| `LICENSES/CC-BY-3.0.txt` | Creative Commons Attribution 3.0 Unported | https://creativecommons.org/licenses/by/3.0/legalcode.txt |
| `LICENSES/CC-BY-4.0.txt` | Creative Commons Attribution 4.0 International | https://creativecommons.org/licenses/by/4.0/legalcode.txt |
| `LICENSES/MPL-2.0.txt` | Mozilla Public License 2.0 | https://www.mozilla.org/media/MPL/2.0/index.txt |
| `LICENSES/NASA-media-guidelines.txt` | Usage note for NASA 3D Resources (no copyright) | https://www.nasa.gov/nasa-brand-center/images-and-media/ |

The licence texts are copied unchanged.

A room under the Mozilla Public License 2.0 ships as a modified, compressed glTF file. Its source
form is available from the repository named in its row below, and the row lists the changes.

## Credits

One row per room, sorted by room id. The first column is the room id (the folder under `rooms/`).

| Room | Title and author | Licence | Source | Changes |
|---|---|---|---|---|
| `art-gallery` | "Neptunian Museum" by Tomcat94. Credit shown: Neptunian Museum by Tomcat94 (opengameart.org/content/neptunian-museum-museum-model), CC0. Converted from COLLADA to glTF; the SketchUp sample figure was removed. | [CC0-1.0](LICENSES/CC0-1.0.txt) | https://opengameart.org/content/neptunian-museum-museum-model (Neptunian Museum.dae (SketchUp 14.1, 2015-04-16; sha256 77ef388f0441)) | COLLADA converted to glTF with three.js ColladaLoader/GLTFExporter (inches and Z-up to metres and Y-up); "Sophie" SketchUp sample figure (Trimble content) and edge lines removed; Phong materials converted to matte PBR; centred, gallery floor at y = 0; textures WebP. The floor-plan image in the download is not used by the DAE and is not shipped. |
| `atrium` | "Hubs Atrium environment" by Hubs Foundation / Mozilla. Credit shown: "Hubs Atrium environment" by Hubs Foundation / Mozilla, MPL-2.0 (github.com/Hubs-Foundation/hubs-atrium-environment @ c1e60c8448c0); modified: navmesh removed, textures recompressed | [MPL-2.0](LICENSES/MPL-2.0.txt) | https://github.com/Hubs-Foundation/hubs-atrium-environment (c1e60c8448c0) | Navmesh removed (earlier conversion to atrium-nonav.gltf); joined, welded and pruned; textures WebP, longest edge 2048 px (4096 px sources downsized); Mozilla wall sign kept (original Mozilla-authored scene). |
| `cave` | "Cave (WebXR Samples)" by Brandon Jones; Poly by Google; Lee Mason; Trackball; parts: "Cave" by Brandon Jones (CC-BY-3.0); "Mushroom" by Poly by Google (CC-BY-3.0); "Bat" by Poly by Google (CC-BY-3.0); "Crystal Cluster" by Lee Mason (CC-BY-3.0); "Tree-2" by Trackball (CC-BY-3.0). Credit shown: "Cave" scene by Brandon Jones; "Mushroom" and "Bat" by Poly by Google; "Crystal Cluster" by Lee Mason; "Tree-2" by Trackball; CC BY 3.0 (https://creativecommons.org/licenses/by/3.0/), from github.com/immersive-web/webxr-samples. Changed: floor levelled, cave widened. | [CC-BY-3.0](LICENSES/CC-BY-3.0.txt) | https://github.com/immersive-web/webxr-samples/tree/main/media/gltf/cave (main branch, downloaded 2026-10-08 (commit not recorded); cave.gltf sha256 33ce4a94a9cf93b3) | Packed glTF + bin to GLB. Floor levelled to y = 0 (terrain heights up to 1.1 m flattened, 1.1-2.2 m stretched down) and the cave widened x2 horizontally, x1.5 vertically; props (mushrooms, crystals, bats, tree, torch) kept their shape, scaled x1.5 and moved with the terrain. Normals of the changed terrain recomputed. |
| `classroom` | "classroom" by Jonathan Granskog. Credit shown: classroom by Jonathan Granskog [CC-BY] (https://creativecommons.org/licenses/by/3.0/) via Poly Pizza (https://poly.pizza/m/2BTjD6QAdt); scaled, room enlarged and furniture rearranged, two desks duplicated, projector and one window removed | [CC-BY-3.0](LICENSES/CC-BY-3.0.txt) | https://poly.pizza/m/2BTjD6QAdt (Poly Pizza model 2BTjD6QAdt, downloaded 2026-10-08 (obj2gltf export)) | Scaled x0.92 (desk tops 0.75 m, seats 0.5 m) with the floor top at y = 0. Layout (SP/roompack/layouts/classroom.json, applied by TOOLS/rooms2/layout.mjs): the untextured floor slab and four box walls stretched to a 12 x 9 m interior (the source is 8.7 x 5.9 m, too small for 4 non-overlapping 3 x 3 m station zones among six desks); the furniture moved, not scaled: 8 desk-and-chair sets (2 duplicated) in four rows of two facing the whiteboard, teacher desk with computer at the front, whiteboard centred on the front wall, bookshelf with the picture above it on the back wall, door between two stations, three windows spread on the side wall, ceiling lights spread over the larger ceiling; fourth window and the ceiling projector removed (the projector carries a brand-like text label of unclear origin). No ceiling in the source: the sky colour #e6e4de stands in for it. |
| `forest-camp` | "Low Poly Forest Scene" by nurbix_studioz. Credit shown: Low Poly Forest Scene by nurbix_studioz [CC-BY] (https://creativecommons.org/licenses/by/3.0/) via Poly Pizza (https://poly.pizza/m/2ZRBoN2Fyb). Changed: scaled x3, trees copied along the edges. | [CC-BY-3.0](LICENSES/CC-BY-3.0.txt) | https://poly.pizza/m/2ZRBoN2Fyb (Poly Pizza model 2ZRBoN2Fyb, downloaded 2026-10-08; sha256 5505fd3eba8cdb28) | Scaled x3 to metres; 15 copies of the scene's own trees and bushes added along the east, north and south edges of the camp bank as an edge boundary (layout forest-camp.json); one copy that blocked the start view replaced by a bush. |
| `house` | "House interior" by Gabriele Romagnoli. Credit shown: House interior by Gabriele Romagnoli [CC-BY] (https://creativecommons.org/licenses/by/3.0/) via Poly Pizza (https://poly.pizza/m/AQQ2g0YE2D). Scaled to metres and meshes merged. | [CC-BY-3.0](LICENSES/CC-BY-3.0.txt) | https://poly.pizza/m/AQQ2g0YE2D (Poly Pizza download 2026-10-08 (sha256 6998000ac0cd)) | Scaled x2.5 to metres (walls 2.5 m, doors about 2 m); floor moved to y = 0; 278 meshes joined into 11; no textures in the source, nothing removed (no logos or signs found). |
| `lake` | "Surrounded Lake" by Hubs Team (Mozilla Hubs). Credit shown: "Surrounded Lake" by Hubs Team (Mozilla Hubs), from github.com/Hubs-Foundation/hubs-blender-files, CC0 1.0; navmesh, collision mesh and spawn points removed, textures recompressed | [CC0-1.0](LICENSES/CC0-1.0.txt) | https://github.com/Hubs-Foundation/hubs-blender-files (Hubs scene UNzm1IH (Mozilla Spoke 1.0.0.20200110004939 export)) | Hubs helpers removed by room-tool (navMesh, trimesh, 4 spawn points); the navmesh kept only as a work file (SP/roompack/work/lake/navmesh.glb), not shipped; lifted 0.1 m so the water surface you walk on is y = 0; the unreadable Terrain_BaseColor JPEG re-encoded losslessly first; textures WebP (1024 px, unchanged size). |
| `lecture-theatre` | "Theatre V0.1" by Cormac White. Credit shown: Theatre V0.1 by Cormac White [CC-BY] (https://creativecommons.org/licenses/by/3.0/) via Poly Pizza (https://poly.pizza/m/8jExwEzwPAe); scaled, side curtains moved, wall lettering removed | [CC-BY-3.0](LICENSES/CC-BY-3.0.txt) | https://poly.pizza/m/8jExwEzwPAe (Poly Pizza model 8jExwEzwPAe, downloaded 2026-10-08 (obj2gltf export)) | Scaled x2.3 with the stage top at y = 0 (the walking level is the stage). Layout (SP/roompack/layouts/lecture-theatre.json): the two gathered side curtains (13 nodes each side) moved 1.1 m outwards so they tuck behind the proscenium pillars and leave the front of the stage clear for a row of stations; white 3D cursive lettering on the stage-right wing wall (9 nodes, about 5,450 triangles) removed as text of unclear origin. 515 source nodes joined into 11 meshes by room-tool. |
| `library` | "Library (assembled from Building Kit and Furniture Kit)" by Kenney; parts: "Building Kit 1.0" by Kenney (www.kenney.nl) (CC0-1.0); "Furniture Kit 2.0" by Kenney (www.kenney.nl) (CC0-1.0). Credit shown: Building Kit and Furniture Kit by Kenney (www.kenney.nl), CC0 (credit optional). Assembled into a room for VR room. | [CC0-1.0](LICENSES/CC0-1.0.txt) | https://kenney.nl/assets/furniture-kit (Building Kit 1.0 (2025-03-29); Furniture Kit 2.0 (2018-10-20)) | Assembled from kit pieces (layout roompack/layouts/library.json): 16 x 12 m reading room, 2.4 m ceiling; furniture scaled x2.1; walls, floor and ceiling tinted; kit animations removed; textures WebP. |
| `meeting-room` | "Cliffside Meeting Room" by Hubs Team; components by mozillareality; parts: "Meeting Space - Hubs Original" by mozillareality (CC-BY-4.0); "Cliff Vista - Hubs Original" by mozillareality (CC-BY-4.0); "Light Fixture - Ceiling Recessed" by mozillareality (CC-BY-4.0). Credit shown: "Meeting Space - Hubs Original", "Cliff Vista - Hubs Original" and "Light Fixture - Ceiling Recessed" by mozillareality (sketchfab.com/mozillareality), CC BY 4.0; scene "Cliffside Meeting Room" by Hubs Team; modified: helpers removed, textures recompressed | [CC-BY-4.0](LICENSES/CC-BY-4.0.txt) | https://github.com/Hubs-Foundation/hubs-blender-files (Hubs scene vhbm7xk (Spoke export 1.0.0.20201019174350)) | Hubs helpers removed (navMesh, trimesh, MeetingSpace_Navmesh, a box collider, 9 waypoints); media frames dropped with the Hubs extension; textures WebP, longest edge 2048 px. |
| `mini-market` | "Mini Market 1.0 (assembled into a shop)" by Kenney, with Fleur Keijsers and Guus Vermeulen. Credit shown: Mini Market by Kenney (www.kenney.nl), with Fleur Keijsers and Guus Vermeulen, CC0 1.0 (credit optional). Assembled into a room for VR room. | [CC0-1.0](LICENSES/CC0-1.0.txt) | https://kenney.nl/assets/mini-market (1.0 (2024-10-25)) | Assembled from kit pieces (layout roompack/layouts/mini-market.json): 20.8 x 18.2 m shop at x2.6, no ceiling (the kit has none); floor lowered 0.065 m to y = 0; character-employee left out; kit animations removed; textures WebP. |
| `mission-control` | "JSC Mission Control Room" by NASA 3D Resources (source: DigitalSpace Corporation). Credit shown: 'JSC Mission Control Room' model courtesy of NASA 3D Resources (source: DigitalSpace Corporation). Use does not imply NASA endorsement. Changed: colours added. | [PD](LICENSES/NASA-media-guidelines.txt) | https://github.com/nasa/NASA-3D-Resources/tree/master/3D%20Models/JSC%20Mission%20Control%20Room (git blob 43f6a670e303 ("JSC Mission Control Room.glb", tree 11ebb4ee0437); sha256 296d6d12bef495bc) | Draco geometry decoded; all 45 materials (black in the source) given plain colours (palette mission-control-palette.json): no textures, no insignia, the wall screen and pictures plain. |
| `museum-entrance` | "The Entryway - Museum Diorama" by Joshua Johanson. Credit shown: The Entryway - Museum Diorama by Joshua Johanson [CC-BY] (https://creativecommons.org/licenses/by/3.0/) via Poly Pizza (https://poly.pizza/m/9bdkTVw8GE8); scaled | [CC-BY-3.0](LICENSES/CC-BY-3.0.txt) | https://poly.pizza/m/9bdkTVw8GE8 (Poly Pizza model 9bdkTVw8GE8, downloaded 2026-10-08 (obj2gltf export)) | Scaled x1.8 (the sweep suggested x1.3 as optional) with the floor top at y = 0 and the hall centred; 528 source nodes joined into 17 meshes by room-tool; geometry otherwise unchanged. Partly roofless: sky #cfd8e0 so the openings read as daylight. |
| `round-table-hall` | "Round Table Room" by Hubs Team; components by plasmaernst; parts: "Round Table Room / empty / Mozilla Hubs" by plasmaernst (CC-BY-4.0); "Door" by plasmaernst (CC-BY-4.0); "Round Table" by plasmaernst (CC-BY-4.0); "Roman Stool" by plasmaernst (CC-BY-4.0); "Banner" by plasmaernst (CC-BY-4.0); "Fountain" by plasmaernst (CC-BY-4.0); "Banner Torn" by plasmaernst (CC-BY-4.0); "Torch" by plasmaernst (CC-BY-4.0). Credit shown: "Round Table Room / empty / Mozilla Hubs", "Door", "Round Table", "Roman Stool", "Banner", "Fountain", "Banner Torn", "Torch" by plasmaernst (sketchfab.com/plasmaernst), CC BY 4.0; Hubs scene by Hubs Team; modified: helpers removed, textures recompressed | [CC-BY-4.0](LICENSES/CC-BY-4.0.txt) | https://github.com/Hubs-Foundation/hubs-blender-files (Hubs scene GLiNzir (Spoke export 1.0.0.20201019174350)) | Hubs helpers removed (navMesh, trimesh, box collider, 8 waypoints); skinned banners and torches kept in their rest pose (animations kept in the file, the viewer does not play them); textures WebP, longest edge 2048 px (6 unreadable JPEGs re-encoded losslessly first). |
| `school` | "Hubs School v1.0" by Hubs Team (Mozilla Hubs / Hubs Foundation). Credit shown: "Hubs School v1.0" by Hubs Team (Mozilla Hubs / Hubs Foundation), from github.com/Hubs-Foundation/hubs-blender-files, CC0 1.0 (originally shared with remixing under CC BY 3.0); modified: posters and Hubs door notes blanked, props simplified, distant pods removed | [CC0-1.0](LICENSES/CC0-1.0.txt) | https://github.com/Hubs-Foundation/hubs-blender-files (Hubs scene OojOIa3 (Spoke export 1.0.0.20201005235520)) | Hubs helpers removed in rooms1/school-prep.mjs with room-tool's rules (navMesh, trimesh, hidden NAVMESH group, 4 spawn points, 192 waypoints, hidden door-frame and nav-mesh-material meshes: 206 helper nodes); the five far-away "breakaway" pods (reached only by Hubs teleport links, 40 m away) cropped out of the merged meshes; reading-area, desk, kid-chair and breakout-chair meshes simplified with meshoptimizer (225,156 -> 78,581 triangles in all); poster atlas wallHangings-combined_diffuse_2048 blanked to neutral grey (posters of unclear origin); "Click to go to Breakout N" notes on the breakout doors painted out in the door diffuse texture and its lightmap; MOZ_lightmap kept (38 lightmapped materials; the 39th belonged only to the cropped pods); textures WebP, longest edge 2048 px. |
| `science-lab` | "Science laboratory (assembled from Lab Assets and Building Kit)" by MilkAndBanana; Kenney; parts: "Lab Assets" by MilkAndBanana (CC0-1.0); "Building Kit 1.0" by Kenney (www.kenney.nl) (CC0-1.0). Credit shown: Lab Assets by MilkAndBanana (CC0); Building Kit by Kenney (www.kenney.nl), CC0 (credit optional). Assembled into a room for VR room. | [CC0-1.0](LICENSES/CC0-1.0.txt) | https://opengameart.org/content/lab-assets (Lab Assets (2022-01-31); Building Kit 1.0 (2025-03-29)) | Assembled from kit pieces (layout roompack/layouts/science-lab.json): 14 x 12 m room, 2.4 m ceiling; lab furniture scaled x0.013 and small props x0.01; walls, floor and ceiling tinted; kit animations removed; textures WebP. |
| `space-station` | "Modular Space Kit and Space Station Kit" by Kenney; parts: "Modular Space Kit 1.0" by Kenney (CC0-1.0); "Space Station Kit 1.0" by Kenney (CC0-1.0). Credit shown: Modular Space Kit and Space Station Kit by Kenney (www.kenney.nl), CC0 1.0 (credit optional). Assembled into a station. | [CC0-1.0](LICENSES/CC0-1.0.txt) | https://kenney.nl/assets/modular-space-kit (Modular Space Kit 1.0 (15-02-2026), Space Station Kit 1.0 (10-04-2024); room-large.glb sha256 fc418d3747a037f8) | Assembled from kit pieces (layout space-station.json): command deck (room-large) with two side rooms (room-small) joined by four corridors, eight gates closing the unused openings, ceilings from turned-over floor tiles, props scaled x2.2-x3; textures WebP. |
| `town-square` | "Fantasy Town Kit 2.0 (assembled into a town square)" by Kenney. Credit shown: Fantasy Town Kit by Kenney (www.kenney.nl), CC0 1.0 (credit optional). Assembled into a room for VR room. | [CC0-1.0](LICENSES/CC0-1.0.txt) | https://kenney.nl/assets/fantasy-town-kit (2.0 (2025-08-03)) | Assembled from kit pieces (layout roompack/layouts/town-square.json): 24 x 24 m cobbled square at x3 with fountain, stalls, carts, benches and lanterns (lanterns x1.8, carts and stools x2.2), closed by thirteen two-storey house fronts and a hedge with a gate; ground lowered 0.075 m to y = 0; kit animations removed; textures WebP. |
