<?php
require_once('PEAR/PackageFileManager.php');

$pkg = new PEAR_PackageFileManager;

$packagedir = dirname(__FILE__);
$self = basename(__FILE__);

$desc = "MP3_Playlist is a php library to facilitate the creation and to some extend the rendering of MP3 playlists.
It scans a local folder with all the MP3 files and outputs the playlist in several formats including M3U, SMIL, XML, XHTML with the possibility to backup the lists on the fly with an SQLite DB.";

$options = array(
    'simpleoutput'      => true,
    'doctype'           => 'D:\Net\www\htdocs\PEAR\PEAR\data\PEAR\package.dtd',
    'package'           => 'MP3_Playlist',
    'license'           => 'PHP License',
    'baseinstalldir'    => '',
    'version'           => '0.5.0alpha1',
    'packagedirectory'  => $packagedir,
    'pathtopackagefile' => $packagedir,
    'state'             => 'alpha',
    'filelistgenerator' => 'file',
    'notes'             => 'Initial release of MP3_Playlist',
    'summary'           => 'Library to create MP3 playlists on the fly, several formats supported including XML, RSS and XHTML',
    'description'       => $desc,
    'dir_roles'         => array(
        'docs'      => 'doc',
        'data'      => 'data'
    ),
    'ignore'            => array(
        'package.xml',
        '*.tgz',
        $self
    )
);

$e = $pkg->setOptions($options);
if (PEAR::isError($e)) {
    echo $e->getMessage();
    die;
}

// hack until they get their shit in line with docroot role
$pkg->addRole('tpl', 'php');
$pkg->addRole('png', 'php');
$pkg->addRole('gif', 'php');
$pkg->addRole('jpg', 'php');
$pkg->addRole('css', 'php');
$pkg->addRole('js', 'php');
$pkg->addRole('ini', 'php');
$pkg->addRole('inc', 'php');
$pkg->addRole('afm', 'php');
$pkg->addRole('pkg', 'doc');
$pkg->addRole('cls', 'doc');
$pkg->addRole('proc', 'doc');
$pkg->addRole('txt', 'doc');
$pkg->addRole('sh', 'script');

$pkg->addMaintainer('gurugeek', 'lead', 'David Costa', 'gurugeek@php.net');
$pkg->addMaintainer('firman', 'lead', 'Firman Wandayandi', 'firman@php.net');

$pkg->addDependency('PHP', '5.0.0', 'ge', 'php');
$pkg->addDependency('PEAR', '1.3.0', 'ge', 'pkg');
$pkg->addDependency('Net_URL', '1.0.14', 'ge', 'pkg');
$pkg->addDependency('MP3_Id', '1.1.4', 'ge', 'pkg');

$e = $pkg->addGlobalReplacement('package-info', '@package_version@', 'version');

$e = $pkg->writePackageFile();
if (PEAR::isError($e)) {
    echo $e->getMessage();
}
?>
