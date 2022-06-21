#!/bin/bash
rm -rf ./output
python3 bookPairs.py
head -30 ./output/part*
