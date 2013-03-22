<?php
namespace ZUMStats\Exceptions;
/**
 * Description of TooMuchNodesException
 *
 * @author Jenda
 */
class InvalidScoreException extends ZUMException {
    private $uncoveredEdges;
    
    public function __construct($message, $uncoveredEdges = array(), $code = 0, Exception $previous = null) {
        $this->uncoveredNodes = $uncoveredEdges;
        parent::__construct($message, $code, $previous);
    }
    
    public function getUncoveredEdges()
    {
        return $this->uncoveredNodes;
    }
    
}

?>
