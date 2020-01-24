<?php
/**
 * ProjectController.php - Main Controller
 *
 * Main Controller Project Module
 *
 * @category Controller
 * @package Project
 * @author Verein onePlace
 * @copyright (C) 2020  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

declare(strict_types=1);

namespace OnePlace\Project\Controller;

use Application\Controller\CoreController;
use Application\Model\CoreEntityModel;
use OnePlace\Project\Model\Project;
use OnePlace\Project\Model\ProjectTable;
use Laminas\View\Model\ViewModel;
use Laminas\Db\Adapter\AdapterInterface;

class ProjectController extends CoreController {
    /**
     * Project Table Object
     *
     * @since 1.0.0
     */
    private $oTableGateway;

    /**
     * ProjectController constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @param ProjectTable $oTableGateway
     * @since 1.0.0
     */
    public function __construct(AdapterInterface $oDbAdapter,ProjectTable $oTableGateway,$oServiceManager) {
        $this->oTableGateway = $oTableGateway;
        $this->sSingleForm = 'project-single';
        parent::__construct($oDbAdapter,$oTableGateway,$oServiceManager);

        if($oTableGateway) {
            # Attach TableGateway to Entity Models
            if(!isset(CoreEntityModel::$aEntityTables[$this->sSingleForm])) {
                CoreEntityModel::$aEntityTables[$this->sSingleForm] = $oTableGateway;
            }
        }
    }

    /**
     * Project Index
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function indexAction() {
        # Set Layout based on users theme
        $this->setThemeBasedLayout('project');

        # Add Buttons for breadcrumb
        $this->setViewButtons('project-index');

        # Set Table Rows for Index
        $this->setIndexColumns('project-index');

        # Get Paginator
        $oPaginator = $this->oTableGateway->fetchAll(true);
        $iPage = (int) $this->params()->fromQuery('page', 1);
        $iPage = ($iPage < 1) ? 1 : $iPage;
        $oPaginator->setCurrentPageNumber($iPage);
        $oPaginator->setItemCountPerPage(3);

        # Log Performance in DB
        $aMeasureEnd = getrusage();
        $this->logPerfomance('project-index',$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"utime"),$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"stime"));

        return new ViewModel([
            'sTableName'=>'project-index',
            'aItems'=>$oPaginator,
        ]);
    }

    /**
     * Project Add Form
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function addAction() {
        # Set Layout based on users theme
        $this->setThemeBasedLayout('project');

        # Get Request to decide wether to save or display form
        $oRequest = $this->getRequest();

        # Display Add Form
        if(!$oRequest->isPost()) {
            # Add Buttons for breadcrumb
            $this->setViewButtons('project-single');

            # Load Tabs for View Form
            $this->setViewTabs($this->sSingleForm);

            # Load Fields for View Form
            $this->setFormFields($this->sSingleForm);

            # Log Performance in DB
            $aMeasureEnd = getrusage();
            $this->logPerfomance('project-add',$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"utime"),$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"stime"));

            return new ViewModel([
                'sFormName' => $this->sSingleForm,
            ]);
        }

        # Get and validate Form Data
        $aFormData = $this->parseFormData($_REQUEST);

        # Save Add Form
        $oProject = new Project($this->oDbAdapter);
        $oProject->exchangeArray($aFormData);
        $iProjectID = $this->oTableGateway->saveSingle($oProject);
        $oProject = $this->oTableGateway->getSingle($iProjectID);

        # Save Multiselect
        $this->updateMultiSelectFields($_REQUEST,$oProject,'project-single');

        # Log Performance in DB
        $aMeasureEnd = getrusage();
        $this->logPerfomance('project-save',$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"utime"),$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"stime"));

        # Display Success Message and View New Project
        $this->flashMessenger()->addSuccessMessage('Project successfully created');
        return $this->redirect()->toRoute('project',['action'=>'view','id'=>$iProjectID]);
    }

    /**
     * Project Edit Form
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function editAction() {
        # Set Layout based on users theme
        $this->setThemeBasedLayout('project');

        # Get Request to decide wether to save or display form
        $oRequest = $this->getRequest();

        # Display Edit Form
        if(!$oRequest->isPost()) {

            # Get Project ID from URL
            $iProjectID = $this->params()->fromRoute('id', 0);

            # Try to get Project
            try {
                $oProject = $this->oTableGateway->getSingle($iProjectID);
            } catch (\RuntimeException $e) {
                echo 'Project Not found';
                return false;
            }

            # Attach Project Entity to Layout
            $this->setViewEntity($oProject);

            # Add Buttons for breadcrumb
            $this->setViewButtons('project-single');

            # Load Tabs for View Form
            $this->setViewTabs($this->sSingleForm);

            # Load Fields for View Form
            $this->setFormFields($this->sSingleForm);

            # Log Performance in DB
            $aMeasureEnd = getrusage();
            $this->logPerfomance('project-edit',$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"utime"),$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"stime"));

            return new ViewModel([
                'sFormName' => $this->sSingleForm,
                'oProject' => $oProject,
            ]);
        }

        $iProjectID = $oRequest->getPost('Item_ID');
        $oProject = $this->oTableGateway->getSingle($iProjectID);

        # Update Project with Form Data
        $oProject = $this->attachFormData($_REQUEST,$oProject);

        # Save Project
        $iProjectID = $this->oTableGateway->saveSingle($oProject);

        $this->layout('layout/json');

        # Save Multiselect
        $this->updateMultiSelectFields($_REQUEST,$oProject,'project-single');

        # Log Performance in DB
        $aMeasureEnd = getrusage();
        $this->logPerfomance('project-save',$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"utime"),$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"stime"));

        # Display Success Message and View New User
        $this->flashMessenger()->addSuccessMessage('Project successfully saved');
        return $this->redirect()->toRoute('project',['action'=>'view','id'=>$iProjectID]);
    }

    /**
     * Project View Form
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function viewAction() {
        # Set Layout based on users theme
        $this->setThemeBasedLayout('project');

        # Get Project ID from URL
        $iProjectID = $this->params()->fromRoute('id', 0);

        # Try to get Project
        try {
            $oProject = $this->oTableGateway->getSingle($iProjectID);
        } catch (\RuntimeException $e) {
            echo 'Project Not found';
            return false;
        }

        # Attach Project Entity to Layout
        $this->setViewEntity($oProject);

        # Add Buttons for breadcrumb
        $this->setViewButtons('project-view');

        # Load Tabs for View Form
        $this->setViewTabs($this->sSingleForm);

        # Load Fields for View Form
        $this->setFormFields($this->sSingleForm);

        # Log Performance in DB
        $aMeasureEnd = getrusage();
        $this->logPerfomance('project-view',$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"utime"),$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"stime"));

        return new ViewModel([
            'sFormName'=>$this->sSingleForm,
            'oProject'=>$oProject,
        ]);
    }
}
