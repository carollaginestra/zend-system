<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGatewayInterface;

/**
 *
 * @author fgsl (www.fgsl.eti.br)
 * @license https://www.gnu.org/licenses/agpl-3.0.en.html GNU Affero General Public License *
 */
class SolicitanteTable
{

    /**
     *
     * @var TableGatewayInterface
     */
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function persist(Solicitante $solicitante)
    {
        $set = $solicitante->toArray();
        $result = $this->tableGateway->select([
            'cpf' => $set['cpf']
        ]);
        if ($result->count() == 0) {
            $this->tableGateway->insert($set);
            return true;
        } else {
            return false;
        }
    }
}