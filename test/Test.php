<?php

use Composer\Composer;
use Composer\Config;
use Composer\Installer\InstallationManager;
use Composer\IO\NullIO;
use Composer\Package\Package;
use COREPOS\ComposerInstaller\Installer;
use COREPOS\ComposerInstaller\Plugin;

class Test extends PHPUnit_Framework_TestCase
{
    public function testPlugin()
    {
        $c = new Composer();
        $c->setConfig(new Config());
        $c->setInstallationManager(new InstallationManager());
        $io = new NullIO();

        $plugin = new Plugin();
        $plugin->activate($c, $io);
    }

    public function testInstaller()
    {
        $c = new Composer();
        $c->setConfig(new Config());
        $c->setInstallationManager(new InstallationManager());
        $io = new NullIO();

        $installer = new Installer($io, $c);
        $this->assertEquals(true, $installer->supports('corepos-lane-plugin'));
        $this->assertEquals(true, $installer->supports('corepos-office-plugin'));
        $this->assertEquals(false, $installer->supports('library'));

        $names = array(
            'corepos/lane-plugin-one' => 'One',
            'corepos/office-plugin-two-words' => 'TwoWords',
            'corepos/non-standard' => 'NonStandard',
        );
        foreach ($names as $from => $to) {
            $pkg = new Package($from, 1, 1);
            $pkg->setType('corepos-lane-plugin');
            $this->assertEquals('pos/is4c-nf/plugins/' . $to, $installer->getInstallPath($pkg));
        }

        // test the other type
        $pkg = new Package('foo/bar', 1, 1);
        $pkg->setType('corepos-office-plugin');
        $this->assertEquals('fannie/modules/plugins2.0/Bar', $installer->getInstallPath($pkg));

        $pkg = new Package('foo', 1, 1);
        $pkg->setType('library');
        try {
            $installer->getInstallPath($pkg);
        } catch (Exception $ex) {
            $this->assertInstanceOf('InvalidArgumentException', $ex);
        }
    }
}

