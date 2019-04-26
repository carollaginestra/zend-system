<?php
namespace Application\Model;

/**
 *
 * @author fgsl (www.fgsl.eti.br)
 * @license https://www.gnu.org/licenses/agpl-3.0.en.html GNU Affero General Public License *
 */
class Demanda
{

    /**
     *
     * @var integer
     */
    public $codigo;

    /**
     *
     * @var Assunto
     */
    public $assunto;

    /**
     *
     * @var Solicitante
     */
    public $solicitante;

    /**
     *
     * @param Solicitante $solicitante
     * @param Assunto $assunto
     */
    public function __construct(Solicitante $solicitante, Assunto $assunto)
    {
        $this->solicitante = $solicitante;
        $this->assunto = $assunto;
    }

    /**
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'codigo_solicitante' => $this->solicitante->cpf,
            'codigo_assunto' => $this->assunto->codigo
        ];
    }
}