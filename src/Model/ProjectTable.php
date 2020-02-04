<?php
/**
 * ProjectTable.php - Project Table
 *
 * Table Model for Project
 *
 * @category Model
 * @package Project
 * @author Verein onePlace
 * @copyright (C) 2020 Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

namespace OnePlace\Project\Model;

use Application\Controller\CoreController;
use Application\Model\CoreEntityTable;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;
use Laminas\Paginator\Paginator;
use Laminas\Paginator\Adapter\DbSelect;

class ProjectTable extends CoreEntityTable {

    /**
     * ProjectTable constructor.
     *
     * @param TableGateway $tableGateway
     * @since 1.0.0
     */
    public function __construct(TableGateway $tableGateway) {
        parent::__construct($tableGateway);

        # Set Single Form Name
        $this->sSingleForm = 'project-single';
    }

    /**
     * Get Project Entity
     *
     * @param int $id
     * @return mixed
     * @since 1.0.0
     */
    public function getSingle($id) {
        # Use core function
        return $this->getSingleEntity($id,'Project_ID');
    }

    /**
     * Save Project Entity
     *
     * @param Project $oProject
     * @return int Project ID
     * @since 1.0.0
     */
    public function saveSingle(Project $oProject) {
        $aData = [
            'label' => $oProject->label,
        ];

        $aData = $this->attachDynamicFields($aData,$oProject);

        $id = (int) $oProject->id;

        if ($id === 0) {
            # Add Metadata
            $aData['created_by'] = CoreController::$oSession->oUser->getID();
            $aData['created_date'] = date('Y-m-d H:i:s',time());
            $aData['modified_by'] = CoreController::$oSession->oUser->getID();
            $aData['modified_date'] = date('Y-m-d H:i:s',time());

            # Insert Project
            $this->oTableGateway->insert($aData);

            # Return ID
            return $this->oTableGateway->lastInsertValue;
        }

        # Check if Project Entity already exists
        try {
            $this->getSingle($id);
        } catch (\RuntimeException $e) {
            throw new \RuntimeException(sprintf(
                'Cannot update project with identifier %d; does not exist',
                $id
            ));
        }

        # Update Metadata
        $aData['modified_by'] = CoreController::$oSession->oUser->getID();
        $aData['modified_date'] = date('Y-m-d H:i:s',time());

        # Update Project
        $this->oTableGateway->update($aData, ['Project_ID' => $id]);

        return $id;
    }

    /**
     * Generate new single Entity
     *
     * @return Project
     * @since 1.0.1
     */
    public function generateNew() {
        return new Project($this->oTableGateway->getAdapter());
    }
}