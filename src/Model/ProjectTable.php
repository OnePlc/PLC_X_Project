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
     * @param string $sKey
     * @return mixed
     * @since 1.0.0
     */
    public function getSingle($id,$sKey = 'Project_ID') {
        # Use core function
        return $this->getSingleEntity($id,$sKey);
    }

    /**
     * Save Project Entity
     *
     * @param Project $oProject
     * @return int Project ID
     * @since 1.0.0
     */
    public function saveSingle(Project $oProject) {
        $aDefaultData = [
            'label' => $oProject->label,
        ];

        return $this->saveSingleEntity($oProject,'Project_ID',$aDefaultData);
    }

    /**
     * Generate new single Entity
     *
     * @return Project
     * @since 1.0.4
     */
    public function generateNew() {
        return new Project($this->oTableGateway->getAdapter());
    }
}