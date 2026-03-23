#!/bin/bash

curl -X POST "http://127.0.0.1:8000/admin/star-systems" \
     -H "Content-Type: application/json" \
     -d '{ "galaxy_id": 1, "name": "Имя", "x": 0.0, "y": 25.0, "z": 50.0, "color_hex": "#ffdd99", "temperature": 5800, "base_scale": 1.0, "owner_player_id": 1, "threat_level": 1 }'