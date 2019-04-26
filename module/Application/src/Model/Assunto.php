<?php
namespace Application\Model;

/**
 *
 * @author fgsl (www.fgsl.eti.br)
 * @license https://www.gnu.org/licenses/agpl-3.0.en.html GNU Affero General Public License *
 */
class Assunto
{

    /**
     *
     * @var integer
     */
    public $codigo;

    /**
     *
     * @var string
     */
    public $assunto;

    /**
     *
     * @var string
     */
    public $detalhes;

    /**
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->codigo = $data['codigo'] ?? null;
        $this->assunto = $data['assunto'] ?? null;
        $this->detalhes = $data['detalhes'] ?? null;
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