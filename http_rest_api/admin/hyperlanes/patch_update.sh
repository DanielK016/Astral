#!/bin/bash

curl -X PATCH "http://127.0.0.1:8000/admin/hyperplanes/1" \
     -H "Content-Type: application/json" \
     -d '{ "galaxy_id": 3, "from_star_system_id": 3, "to_star_system_id": 4 }'