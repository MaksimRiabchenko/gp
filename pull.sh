#!/bin/bash

git checkout dev
git pull
./yii migrate --interactive=0
composer update
git status

