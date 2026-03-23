#!/bin/bash

curl -X POST "http://127.0.0.1:8000/game/session/1/end-turn" \
     -H "Content-Type: application/json" \
     -d '{}'