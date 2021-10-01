#!/bin/bash

cd ./laradock \
        && docker-compose down

# the -T flag disables pseudo-tty allocation.
