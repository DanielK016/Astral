#!/bin/bash

curl -X POST "http://127.0.0.1:8000/new-game/difficulty" \
     -H "Content-Type: application/json" \
     -d '{ "difficulty": "normal", "galaxy_size": "medium", "ai_count": 2 }'