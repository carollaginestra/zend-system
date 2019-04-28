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
    public $codigo_assunto;

    /**
     *
     * @var Solicitante
     */
    public $codigo_solicitante;

    /**
     *
     * @param Solicitante $solicitante
     * @param Assunto $assunto
     */
    public function __construct(array $data){
        $this->codigo_solicitante = $data['codigo_solicitante'] ?? null;
        $this->codigo_assunto = $data['codigo_assunto'] ?? null;
    }   

    /**
     *
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }
}