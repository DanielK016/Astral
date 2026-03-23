#!/bin/bash

curl -X PUT "http://127.0.0.1:8000/admin/races/1" \
     -H "Content-Type: application/json" \
     -d '{ "name": "Name", "description": "Description", "color_hex": "#00aaff", "traits_json": ["Data"], "home_star_system_id": 2 }'