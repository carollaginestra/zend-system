<?php
namespace Application\Model;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Db\TableGateway\TableGateway;

/**
 *
 * @author fgsl (www.fgsl.eti.br)
 * @license https://www.gnu.org/licenses/agpl-3.0.en.html GNU Affero General Public License *
 */
class SolicitanteTableFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $adapter = $container->get('DbAdapter');
        $tableGateway = new TableGateway('solicitante', $adapter);
        return new SolicitanteTable($tableGateway);
    }
}
