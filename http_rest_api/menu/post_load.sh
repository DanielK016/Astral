#!/bin/bash

curl -X POST "http://127.0.0.1:8000/continue/1/load" \
     -H "Content-Type: application/json" \
     -d '{ "name": "Новая галактика", "seed": 1, "size": 300, "arms": 4, "notes": "Примечания" }'