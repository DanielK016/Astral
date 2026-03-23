#!/bin/bash

curl -X PUT "http://127.0.0.1:8000/admin/planets/1" \
     -H "Content-Type: application/json" \
     -d '{ "star_system_id": 2, "name": "Name", "type": "desert", "orbit_radius": 20.0, "radius": 2.0, "axial_tilt": 2.0, "rotation_speed": 2.0, "has_rings": true, "meta_json": ["Data"], "size_slots": 20, "population": 20, "happiness": 2.0, "specialization": "balanced", "is_capital": true, "base_yields": ["Data"] }'