#!/bin/bash

curl -X POST "http://127.0.0.1:8000/new-game/race" \
     -H "Content-Type: application/json" \
     -d '{ "race_key": "Data" }'