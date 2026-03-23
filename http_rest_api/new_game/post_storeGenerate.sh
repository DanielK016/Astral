#!/bin/bash

curl -X POST "http://127.0.0.1:8000/new-game/generate/run" \
     -H "Content-Type: application/json" \
     -d '{}'