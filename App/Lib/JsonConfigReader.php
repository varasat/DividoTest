<?php


    namespace App\Lib;


    use App\Lib\Interfaces\ConfigReader;
    use App\Lib\Interfaces\FileReader;
    use App\Models\ConfigurationConcrete;

    /**
     * Class JsonConfigReader
     * @package App\Lib
     */
    class JsonConfigReader implements ConfigReader
    {
        /**
         * @var FileReader
         */
        private FileReader $fileReader;

        /**
         * JsonConfigReader constructor.
         * @param  FileReader  $fileReader
         */
        public function __construct(FileReader $fileReader)
        {
            $this->fileReader = $fileReader;
        }

        /**
         * @param  string  $search
         * @return array
         */
        public function readConfig(string $search = ''): array
        {
            $configContents = json_decode(
                $this->fileReader->getContentsOfFile(ConfigurationConcrete::CONFIG_FILE_PATH),
                1
            );
            if (empty($search)) {
                return $configContents;
            }
            $searchArray = explode('.', $search);
            $currentContext = $configContents;
            $result = [];
            foreach ($searchArray as $searchSection) {
                if (isset($currentContext[$searchSection])) {
                    $result = [$searchSection => $currentContext[$searchSection]];
                    $currentContext = $currentContext[$searchSection];
                } else {
                    $result = [];
                    break;
                }
            }
            if (!empty($result)) {
                return $result;
            }
            return [
                'error' => 'Search terms invalid'
            ];
        }
    }