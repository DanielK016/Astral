#!/bin/bash

curl -X PUT "http://127.0.0.1:8000/admin/star-systems/1" \
     -H "Content-Type: application/json" \
     -d '{ "galaxy_id": 2, "name": "Name", "x": 25.0, "y": 50.0, "z": 75.0, "color_hex": "#ffdd99", "temperature": 11600, "base_scale": 2.0, "owner_player_id": 2, "threat_level": 2 }'