#!/bin/bash

curl -X POST "http://127.0.0.1:8000/game/session/1/research" \
     -H "Content-Type: application/json" \
     -d '{ "research_key": "Data" }'