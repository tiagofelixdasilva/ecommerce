<?php


namespace Hcode;

use Rain\tpl;
/*$config = array(
    "tpl_dir"       => $_SERVER['DOCUMENT_ROOT'] . "/views/",
    "cache_dir"     => $_SERVER['DOCUMENT_ROOT'] . "/views-cache/",
    "debug"         => false // set to false to improve the speed
);

Tpl::configure( $config );
$tpl  = new Tpl;


$tpl->draw("header");*/


class Page
{

    private $tpl;
    private $options = array();
    private $default = [
      "data" => []
    ];

            public function __construct($opts = array())
            {
                $this->options  = array_merge($this->default, $opts);

                $config = array(
                    "tpl_dir"       => $_SERVER['DOCUMENT_ROOT'] . "/views/",
                    "cache_dir"     => $_SERVER['DOCUMENT_ROOT'] . "/views-cache/",
                    "debug"         => false     // set to false to improve the speed
                );

                Tpl::configure( $config );

                $this->tpl  = new Tpl;

                $this->setData($this->options["data"]);

                $this->tpl->draw("header");

            }

            public function setData($data = array())
            {
                foreach ($data as  $key => $value)
                {
                    $this->tpl->assign($key,$value);
                }
            }


            public function setTpl($name, $data = array() , $returnHTML = false)
            {
                $this->setData($data);

                return $this->tpl->draw($name,$returnHTML);
            }

            public function __destruct()
            {

                $this->tpl->draw("footer");

            }
}