<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;

/**
 *
 * @author fgsl (www.fgsl.eti.br)
 * @license https://www.gnu.org/licenses/agpl-3.0.en.html GNU Affero General Public License *
 */
class AssuntoTable
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
     * @param Assunto $assunto
     */
    public function persist(Assunto $assunto)
    {
        $set = $assunto->toArray();
        $result = $this->tableGateway->select([
            'assunto' => $set['assunto']
        ]);
        if ($result->count() == 0) {
            $this->tableGateway->insert($set);
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * @return integer
     */
    public function getMaxCodigo()
    {
        $expression = new Expression('max(codigo)');

        $select = new Select('assunto');
        $select->columns([
            'codigoAssunto' => $expression
        ]);
        return $this->tableGateway->selectWith($select)->current()['codigoAssunto'];
    }
}