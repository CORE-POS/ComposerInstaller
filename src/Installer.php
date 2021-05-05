<?php

namespace COREPOS\ComposerInstaller;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

class Installer extends LibraryInstaller
{
    public function supports($packageType)
    {
        return ($packageType === 'corepos-lane-plugin' || $packageType === 'corepos-office-plugin');
    }

    public function getInstallPath(PackageInterface $package)
    {
        if ($package->getType() === 'corepos-lane-plugin') {
            return 'pos/is4c-nf/plugins/' . $this->formatName($package->getPrettyName());
        } elseif ($package->getType() === 'corepos-office-plugin') {
            return 'fannie/modules/plugins2.0/' . $this->formatName($package->getPrettyName());
        }

        throw new \InvalidArgumentException('Package type ' . $package->getType() . ' not supported');
    }

    private function formatName($name)
    {
        list($vendor, $package) = explode('/', $name, 2);
        $pieces = explode('-', $package);
        $good = array_reduce($pieces, function($c, $i){ return $c . ucfirst($i); });
        if (substr($good, 0, 10) === 'LanePlugin') {
            return substr($good, 10);
        } elseif (substr($good, 0, 12) === 'OfficePlugin') {
            return substr($good, 12);
        } else {
            return $good;
        }
    }
}

