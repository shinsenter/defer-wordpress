#!/bin/bash

# git checkout master
# git fetch --all
# git reset --hard origin/master
# git pull

rm -Rf vendor
base_dir=`pwd`
build_dir=$base_dir/_dist_/build

composer install -o -a -n --no-dev --prefer-dist --no-suggest

plugin_url=https://plugins.svn.wordpress.org/
plugin_name=shins-pageload-magic
plugin_svn=$plugin_url/$plugin_name
plugin_dir=$build_dir/$plugin_name
black_list=$base_dir/_dist_/blacklist.txt

version=`head -n 1 $base_dir/VERSION`

echo "Deploy version ${version} ${build_dir}"

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
svn rm trunk/* --force

cd $base_dir
rsync -aHxW --delete --exclude-from=$black_list $base_dir/ $plugin_dir/trunk/
mv $plugin_dir/trunk/defer-wordpress.php $plugin_dir/trunk/$plugin_name.php
composer fixer _dist_
echo ""

# ------------------------------------------------------------------------------
echo "Release $version"
cd $plugin_dir
svn add trunk/* --force
svn stat
svn ci -m "Release $version" --username=shinsenter
echo ""

# ------------------------------------------------------------------------------
echo "Add new tag $version"
svn up tags/$version --force
if [[ -e $plugin_dir ]]; then
    svn rm tags/$version --force
    rm -Rf tags/$version
fi
echo ""

# ------------------------------------------------------------------------------
echo "Tagging version $version"
svn cp trunk tags/$version
svn ci -m "Tagging version $version" --username=shinsenter
