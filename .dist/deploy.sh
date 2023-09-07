#!/bin/bash

shopt -s expand_aliases
alias sed=$(which gsed)

# git checkout master
# git fetch --all
# git reset --hard origin/master
# git pull

rm -Rf vendor
base_dir="$(pwd)"
build_dir=$base_dir/.dist/build

echo
echo $base_dir

# Install modules
composer pull

# Prepare
plugin_url=https://plugins.svn.wordpress.org
plugin_name=shins-pageload-magic
plugin_svn=$plugin_url/$plugin_name
plugin_dir=$build_dir/$plugin_name
black_list=$base_dir/.dist/blacklist.txt

version=`head -n 1 $base_dir/VERSION`
echo "Deploy version ${version} ${build_dir}"
sed -i "s/\(Version:\s\+\).\+$/\\1${version}/" $base_dir/defer-wordpress.php
sed -i "s/'DEFER_WP_PLUGIN_VERSION', '.*'/'DEFER_WP_PLUGIN_VERSION', '${version}'/" $base_dir/defer-wordpress.php

if [[ ! -e $plugin_dir ]]; then
    echo "Clone from $plugin_svn"
    rm -Rf $build_dir
    mkdir -p $plugin_dir
    svn co --depth immediates $plugin_svn $plugin_dir
    svn co --depth infinity $plugin_svn/assets $plugin_dir/assets
    svn co --depth infinity $plugin_svn/trunk $plugin_dir/trunk
fi
echo ""

# ------------------------------------------------------------------------------
echo "Copy from source"
cd $plugin_dir
svn rm --force trunk/*

cd $base_dir
rsync -aHxW --delete --exclude-from=${black_list/$base_dir/.} ./ ${plugin_dir/$base_dir/.}/trunk/
mv $plugin_dir/trunk/defer-wordpress.php $plugin_dir/trunk/$plugin_name.php
# composer fixer .dist
echo ""

# ------------------------------------------------------------------------------
echo "Release $version"
cd $plugin_dir
svn add --force trunk/*
svn stat
svn ci -m "Release $version" --username=shinsenter
echo ""

# ------------------------------------------------------------------------------
echo "Add new tag $version"
svn up --force tags/$version
if [[ -e $plugin_dir ]]; then
    svn rm --force tags/$version
    rm -Rf tags/$version
fi
echo ""

# ------------------------------------------------------------------------------
echo "Tagging version $version"
svn cp trunk tags/$version
svn ci -m "Tagging version $version" --username=shinsenter
