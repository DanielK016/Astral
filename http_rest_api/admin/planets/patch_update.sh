#!/bin/bash

curl -X PATCH "http://127.0.0.1:8000/admin/planets/1" \
     -H "Content-Type: application/json" \
     -d '{ "star_system_id": 3, "name": "Nom", "type": "ocean", "orbit_radius": 30.0, "radius": 3.0, "axial_tilt": 3.0, "rotation_speed": 3.0, "has_rings": false, "meta_json": ["Données"], "size_slots": 30, "population": 30, "happiness": 3.0, "specialization": "balanced", "is_capital": false, "base_yields": ["Données"] }'