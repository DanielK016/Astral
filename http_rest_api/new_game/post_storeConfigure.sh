#!/bin/bash

curl -X POST "http://127.0.0.1:8000/new-game/configure" \
     -H "Content-Type: application/json" \
     -d '{ "player_name": "Name", "ai_count": 2, "galaxy_size": "medium" }'