#!/bin/bash

curl -X POST "http://127.0.0.1:8000/admin/planets" \
     -H "Content-Type: application/json" \
     -d '{ "star_system_id": 1, "name": "Имя", "type": "rock", "orbit_radius": 10.0, "radius": 1.0, "axial_tilt": 1.0, "rotation_speed": 1.0, "has_rings": false, "meta_json": ["Данные"], "size_slots": 10, "population": 10, "happiness": 1.0, "specialization": "balanced", "is_capital": false, "base_yields": ["Данные"] }'