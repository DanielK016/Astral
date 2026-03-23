#!/bin/bash

curl -X POST "http://127.0.0.1:8000/game/session/1/planet/1/build" \
     -H "Content-Type: application/json" \
     -d '{ "building_key": "Data", "slot_index": 1 }'