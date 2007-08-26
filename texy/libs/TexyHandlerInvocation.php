<?php

/**
 * This file is part of the Texy! formatter (http://texy.info/)
 *
 * @author     David Grudl
 * @copyright  Copyright (c) 2004-2007 David Grudl aka -dgx- (http://www.dgx.cz)
 * @license    GNU GENERAL PUBLIC LICENSE version 2 or 3
 * @version    $Revision$ $Date$
 * @category   Text
 * @package    Texy
 */


// security - include texy.php, not this file
if (!class_exists('Texy', FALSE)) die();



/**
 * Around advice handlers
 */
final class TexyHandlerInvocation
{
    /** @var array of callbacks */
    private $handlers;

    /** @var int  callback counter */
    private $pos;

    /** @var array */
    private $args;

    /** @var TexyParser */
    private $parser;



    /**
     * @param array    array of callbacks
     * @param TexyParser
     * @param array    arguments
     */
    public function __construct($handlers, TexyParser $parser, $args)
    {
        $this->handlers = $handlers;
        $this->pos = count($handlers);
        $this->parser = $parser;
        array_unshift($args, $this);
        $this->args = $args;
    }



    /**
     * @param mixed
     * @return mixed
     */
    public function proceed()
    {
        if ($this->pos === 0) {
            throw new Exception('No more handlers');
        }

        if (func_num_args()) {
            $this->args = func_get_args();
            array_unshift($this->args, $this);
        }

        $this->pos--;
        return call_user_func_array($this->handlers[$this->pos], $this->args);
    }



    /**
     * @return TexyParser
     */
    public function getParser()
    {
        return $this->parser;
    }



    /**
     * @return Texy
     */
    public function getTexy()
    {
        return $this->parser->getTexy();
    }



    /**
     * PHP garbage collector helper
     */
    public function free()
    {
        $this->handlers = $this->parser = $this->args = NULL;
    }

}