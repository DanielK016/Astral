#!/bin/bash

curl -X PATCH "http://127.0.0.1:8000/admin/races/1" \
     -H "Content-Type: application/json" \
     -d '{ "name": "Nom", "description": "Description", "color_hex": "#00aaff", "traits_json": ["Données"], "home_star_system_id": 3 }'