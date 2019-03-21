#!/bin/bash

# git checkout master
# git fetch --all
# git reset --hard origin/master
# git pull

rm -Rf vendor
composer install -o -a -n

base_dir=`pwd`
build_dir=$base_dir/_dist_/build

plugin_url=https://plugins.svn.wordpress.org/
plugin_name=shins-pageload-magic
plugin_svn=$plugin_url/$plugin_name/
plugin_dir=$build_dir/$plugin_name

version=`head -n 1 $base_dir/_dist_/VERSION`

if [[ ! -e $plugin_dir ]]; then
    rm -Rf $build_dir
    mkdir -p $plugin_dir
    svn co $plugin_svn $plugin_dir
fi

svn rm $plugin_dir/trunk/* --force
rsync -aHxW --delete --exclude-from=$base_dir/_dist_/blacklist.txt $base_dir/ $plugin_dir/trunk/

cd $plugin_dir
mv trunk/defer-wordpress.php $plugin_dir/trunk/$plugin_name.php
svn stat

svn add trunk/* --force
svn ci -m "Release $version" --username=shinsenter --force-interactive

svn cp trunk tags/$version
svn ci -m "Tagging version $version" --username=shinsenter --force-interactive
