#!/bin/bash

curl -X POST "http://127.0.0.1:8000/admin/hyperplanes" \
     -H "Content-Type: application/json" \
     -d '{ "galaxy_id": 1, "from_star_system_id": 1, "to_star_system_id": 2 }'