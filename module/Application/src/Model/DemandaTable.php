<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGatewayInterface;

/**
 *
 * @author fgsl (www.fgsl.eti.br)
 * @license https://www.gnu.org/licenses/agpl-3.0.en.html GNU Affero General Public License *
 */
class DemandaTable
{

    /**
     *
     * @var TableGatewayInterface
     */
    private $tableGateway;

    /**
     *
     * @param TableGatewayInterface $tableGateway
     */
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     *
     * @param Demanda $demanda
     */
    public function persist(Demanda $demanda)
    {
        $set = $demanda->toArray();
        try {
            $this->tableGateway->insert($set);
        } catch (\Exception $e) {}
    }
}