#!/bin/bash

curl -X POST "http://127.0.0.1:8000/game/api/session/1/galaxy/move-fleets" \
     -H "Content-Type: application/json" \
     -d '{ "fleet_id": 1, "target_star_system_id": 2 }'