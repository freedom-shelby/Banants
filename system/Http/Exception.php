<?php
/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 26.05.2015
 * Time: 8:17
 * Ошибки HTTP
 */
namespace Http {
    class Exception extends \Exception{

        public function __construct($code, $message = null, Exception $previous = null){
            // убедитесь, что все передаваемые параметры верны
            parent::__construct($message, $code, $previous);
            $this->DetectException($code,$message);
        }

        /**
         * Определяет ошибку по коду, и выфбрасывает нужный метод
         * @param $code
         * @param $message
         */
        private function DetectException($code,$message){
            switch($code){
                case 400: $this->Exc400($message); break;
                case 403: $this->Exc403($message); break;
                case 404: $this->Exc404($message); break;
                case 500: $this->Exc500($message); break;
            }
        }

        /**
         * 404 Ошибка
         * @param $message
         */
        public function Exc404($message){
            $this->message = $message ?: \View::make('front/content/error_404'); // todo: исползовать если есть картинка
//            $this->message = $message ?: "<h1>404 Not Found</h1>The page that you have requested could not be found.";

            header('HTTP/1.0 404 Not Found'); die($this->message);
        }

        /**
         * 400 Ошибка
         * @param $message
         */
        public function Exc400($message){
            header('HTTP/1.0 400 Bad Request');
            $this->message = $message ?: "<h1>400 Bad Request</h1>";
            die($this->message);
        }

        /**
         * 500 Ошибка
         * @param $message
         */
        public function Exc500($message){
            $this->message = $message ?: "<h1>500 Server Error</h1>";
            header('HTTP/1.0 500 Server Error'); die($this->message);
        }

        /**
         * 403 Ошибка
         * @param $message
         */
        public function Exc403($message){
            header('HTTP/1.0 403 Forbidden');
            $this->message = "<h1>403 Forbidden</h1>";
            die($this->message);
        }
    }
}