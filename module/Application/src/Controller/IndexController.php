<?php
namespace Application\Controller;

use Application\Model\Assunto;
use Application\Model\Demanda;
use Application\Model\Solicitante;
use Interop\Container\ContainerInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 *
 * @author fgsl (www.fgsl.eti.br)
 * @license https://www.gnu.org/licenses/agpl-3.0.en.html GNU Affero General Public License *
 */
class IndexController extends AbstractActionController
{

    /**
     *
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    public function processarAction()
    {
        $solicitante = new Solicitante($_POST);
        $assunto = new Assunto($_POST);

        $_SESSION['dados'] = [
            'solicitante' => $solicitante,
            'assunto' => $assunto
        ];

        if (empty($solicitante->cpf) || empty($assunto->assunto) || empty($assunto->detalhes)) {
            $_SESSION['mensagem'] = 'Preencha os campos!';
            return $this->redirect()->toRoute('application');
        }

        $solicitanteTable = $this->container->get('SolicitanteTable');

        $solicitanteTable->persist($solicitante);

        $assuntoTable = $this->container->get('AssuntoTable');

        $result = $assuntoTable->getByAssunto($assunto->assunto);

        if ($result->count() > 0) {
            $_SESSION['dados']['detalhes_gravados'] = $result->current()['detalhes'];
            return $this->redirect()->toRoute('application');
        } else {
            $assuntoTable->persist($assunto);
        }

        $demanda = new Demanda($solicitante, $assunto);

        $demandaTable = $this->container->get('DemandaTable');
        $demandaTable->persist($demanda);

        $_SESSION['dados'] = [];

        return new ViewModel();
    }
}
