<?php

    namespace App\Lib;

    /**
     * Class Request
     * @package App\Lib
     */
    class Request
    {
        /**
         * @var array|mixed
         */
        private $params;

        /**
         * Request constructor.
         * @param  array  $params
         */
        public function __construct(array $params = [])
        {
            $this->params = $params;
        }

        /**
         * @return array|mixed
         */
        public function getParams()
        {
            return $this->params;
        }

    }