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
plugin_svn=$plugin_url/$plugin_name
plugin_dir=$build_dir/$plugin_name

version=`head -n 1 $base_dir/_dist_/VERSION`

if [[ ! -e $plugin_dir ]]; then
    rm -Rf $build_dir
    mkdir -p $plugin_dir
    # svn co $plugin_svn $plugin_dir
    svn co --depth immediates $plugin_svn $plugin_dir
    svn co --depth infinity $plugin_svn/assets $plugin_dir/assets
    svn co --depth infinity $plugin_svn/trunk $plugin_dir/trunk
fi

cd $plugin_dir

if [[ ! -e $plugin_dir/tags/$version ]]; then
    svn rm tags/$version
    rm -Rf $plugin_dir/tags/$version
fi

svn rm trunk/* --force
rsync -aHxW --delete --exclude-from=$base_dir/_dist_/blacklist.txt $base_dir/ $plugin_dir/trunk/
mv trunk/defer-wordpress.php $plugin_dir/trunk/$plugin_name.php

svn add trunk/* --force
svn stat

svn ci -m "Release $version" --username=shinsenter --force-interactive
svn cp trunk tags/$version -m "Tagging version $version" --username=shinsenter --force-interactive
