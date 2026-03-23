#!/bin/bash

curl -X PUT "http://127.0.0.1:8000/admin/galaxies/1" \
     -H "Content-Type: application/json" \
     -d '{ "name": "New galaxy", "seed": 2, "size": 600, "arms": 8, "notes": "Notes" }'