<?php
/**
 * ExportController.php - Project Export Controller
 *
 * Main Controller for Project Export
 *
 * @category Controller
 * @package Project
 * @author Verein onePlace
 * @copyright (C) 2020  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.1
 */

namespace OnePlace\Project\Controller;

use Application\Controller\CoreController;
use Application\Controller\CoreExportController;
use OnePlace\Project\Model\ProjectTable;
use Laminas\Db\Sql\Where;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\View\Model\ViewModel;


class ExportController extends CoreExportController
{
    /**
     * ApiController constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @param ProjectTable $oTableGateway
     * @since 1.0.0
     */
    public function __construct(AdapterInterface $oDbAdapter,ProjectTable $oTableGateway,$oServiceManager) {
        parent::__construct($oDbAdapter,$oTableGateway,$oServiceManager);
    }


    /**
     * Dump Projects to excel file
     *
     * @return ViewModel
     * @since 1.0.1
     */
    public function dumpAction() {
        $this->layout('layout/json');

        # Use Default export function
        $aViewData = $this->exportData('Projects','project');

        # return data to view (popup)
        return new ViewModel($aViewData);
    }
}