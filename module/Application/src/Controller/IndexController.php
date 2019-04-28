<?php
namespace Application\Controller;

use Application\Model\Assunto;
use Application\Model\AssuntoTable;
use Application\Model\Demanda;
use Application\Model\DemandaTable;
use Application\Model\Solicitante;
use Application\Model\SolicitanteTable;
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
            $_SESSION['dados']['mensagem'] = 'Preencha os campos! *';
            return $this->redirect()->toRoute('application');
        }

        $solicitanteTable = $this->container->get('SolicitanteTable');


        if (!$solicitanteTable->persist($solicitante)) {
            $_SESSION['dados']['mensagem'] = "O CPF já existe";
            return $this->redirect()->toRoute('application');
        }

        $assuntoTable = $this->container->get('AssuntoTable');

        if (!$assuntoTable->persist($assunto)) {
            $_SESSION['dados']['mensagem'] = "O Assunto já existe";
            return $this->redirect()->toRoute('application');
        }

        $codigoAssunto = $assuntoTable->getMaxCodigo();

        $data = array ('codigo_solicitante' => $solicitante->cpf, 'codigo_assunto' => $codigoAssunto);

        $demanda = new Demanda($data);

        $demandaTable = $this->container->get('DemandaTable');
        $demandaTable->persist($demanda);

        $_SESSION['dados'] = [];
        $_SESSION['dados']['mensagem'] = "Cadastro Realizado";

        return $this->redirect()->toRoute('application');
    }
}
