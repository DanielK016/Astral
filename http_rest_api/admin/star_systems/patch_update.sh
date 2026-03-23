#!/bin/bash

curl -X PATCH "http://127.0.0.1:8000/admin/star-systems/1" \
     -H "Content-Type: application/json" \
     -d '{ "galaxy_id": 2, "name": "Nom", "x": 50.0, "y": 75.0, "z": 100.0, "color_hex": "#ffdd99", "temperature": 16800, "base_scale": 3.0, "owner_player_id": 3, "threat_level": 3 }'