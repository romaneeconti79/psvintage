<?php

/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License version 3.0
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 */

namespace PrestaShop\Module\Ps_metrics;

use PrestaShop\Module\Ps_metrics\Config\Env;
use PrestaShop\Module\Ps_metrics\Handler\NativeStatsHandler;
use PrestaShop\Module\Ps_metrics\Helper\ConfigHelper;
use PrestaShop\Module\Ps_metrics\Helper\PrestaShopHelper;
use PrestaShop\Module\Ps_metrics\Helper\SegmentHelper;
use PrestaShop\Module\Ps_metrics\Helper\ShopHelper;
use PrestaShop\Module\Ps_metrics\Helper\ToolsHelper;
use PrestaShop\Module\Ps_metrics\Module\Install;
use PrestaShop\Module\Ps_metrics\Repository\ConfigurationRepository;
use PrestaShop\Module\Ps_metrics\Repository\HookModuleRepository;
use PrestaShop\Module\Ps_metrics\Tracker\Segment;
use PrestaShop\PsAccountsInstaller\Installer\Facade\PsAccounts;
use PrestaShop\PsAccountsInstaller\Installer\Installer;

class LegacyModuleInstaller
{
    /**
     * @var \Ps_metrics
     */
    private $module;

    /**
     * @var ConfigurationRepository
     */
    private $configurationRepository;

    public function __construct(\Ps_metrics $module)
    {
        $this->module = $module;
        $this->configurationRepository = (new ConfigurationRepository(
            (new PrestaShopHelper())
        ));
    }

    /**
     * The service container is not available during the install process.
     * This method is used to manually instantiate PrestaShop\Module\Ps_metrics\Module\Install required
     * at module install
     *
     * Code to delete once the issue was fixed on PrestaShop side
     *
     * @return Install
     */
    public function legacyModuleInstaller()
    {
        return new Install(
            $this->module,
            $this->configurationRepository,
            (new HookModuleRepository())
        );
    }

    /**
     * The service container is not available during the install process.
     * This method is used to manually instantiate PrestaShop\Module\Ps_metrics\Helper\SegmentHelper required
     * at module install
     *
     * Code to delete once the issue was fixed on PrestaShop side
     *
     * @return Segment
     */
    public function legacyModuleInstallerSegment()
    {
        return new Segment(
            (new SegmentHelper(
                (new ConfigHelper(
                    (new Env($this->module))
                ))
            )),
            (new PrestaShopHelper()),
            (new ShopHelper(
                (new ToolsHelper())
            ))
        );
    }

    /**
     * The service container is not available during the install process.
     * This method is used to manually instantiate PrestaShop\Module\Ps_metrics\Helper\SegmentHelper required
     * at module install
     *
     * Code to delete once the issue was fixed on PrestaShop side
     *
     * @return NativeStatsHandler
     */
    public function legacyNativeStatsHandler()
    {
        return new NativeStatsHandler(
        $this->module,
        (new PsAccounts(
            (new Installer('5.0'))
        )),
        $this->configurationRepository
      );
    }
}
