#!/bin/bash

curl -X POST "http://127.0.0.1:8000/admin/races" \
     -H "Content-Type: application/json" \
     -d '{ "name": "Имя", "description": "Описание", "color_hex": "#00aaff", "traits_json": ["Данные"], "home_star_system_id": 1 }'