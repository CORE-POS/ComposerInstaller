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
            return 'pos/is4c-nf/plugins/' . $package->getPrettyName();
        } elseif ($package->getType() === 'corepos-office-plugin') {
            return 'fannie/modules/plugins2.0/' . $package->getPrettyName();
        }

        throw new \InvalidArgumentException('Package type ' . $package->getType() . ' not supported');
    }
}

