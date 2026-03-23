#!/bin/bash

curl -X PATCH "http://127.0.0.1:8000/admin/galaxies/1" \
     -H "Content-Type: application/json" \
     -d '{ "name": "Nouvelle galaxie", "seed": 3, "size": 900, "arms": 12, "notes": "Remarques" }'