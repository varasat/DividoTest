<?php


    namespace App\Lib;


    use App\Exceptions\FileDoesNotExistException;
    use App\Exceptions\FileNotJsonException;
    use App\Exceptions\JsonIsNotValidException;
    use App\Lib\Interfaces\FileValidator;

    class JsonFileValidator implements FileValidator
    {
        const JSON_TYPE = 'json';

        /**
         * @throws FileNotJsonException
         * @throws FileDoesNotExistException
         */
        public function validateFile($path): bool
        {
            $fileExists = file_exists($path);
            if (!$fileExists) {
                throw new FileDoesNotExistException('File '.$path.' does not exist');
            }
            $fileType = pathinfo($path, PATHINFO_EXTENSION);
            if ($fileType != self::JSON_TYPE) {
                throw new FileNotJsonException('File '.$path.' is not a JSON file');
            }
            return true;
        }

        /**
         * @throws JsonIsNotValidException
         */
        public function validateFileContent(string $fileContent): bool
        {
            json_decode($fileContent);
            switch (json_last_error()) {
                case JSON_ERROR_NONE:
                    $error = ''; // JSON is valid // No error has occurred
                    break;
                case JSON_ERROR_DEPTH:
                    $error = 'The maximum stack depth has been exceeded.';
                    break;
                case JSON_ERROR_STATE_MISMATCH:
                    $error = 'Invalid or malformed JSON.';
                    break;
                case JSON_ERROR_CTRL_CHAR:
                    $error = 'Control character error, possibly incorrectly encoded.';
                    break;
                case JSON_ERROR_SYNTAX:
                    $error = 'Syntax error, malformed JSON.';
                    break;
                // PHP >= 5.3.3
                case JSON_ERROR_UTF8:
                    $error = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
                    break;
                // PHP >= 5.5.0
                case JSON_ERROR_RECURSION:
                    $error = 'One or more recursive references in the value to be encoded.';
                    break;
                // PHP >= 5.5.0
                case JSON_ERROR_INF_OR_NAN:
                    $error = 'One or more NAN or INF values in the value to be encoded.';
                    break;
                case JSON_ERROR_UNSUPPORTED_TYPE:
                    $error = 'A value of a type that cannot be encoded was given.';
                    break;
                default:
                    $error = 'Unknown JSON error occured.';
                    break;
            }
            if (!empty($error)) {
                throw new JsonIsNotValidException($error);
            }
            return true;
        }
    }