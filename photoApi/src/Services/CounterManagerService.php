<?php


namespace App\Services;


class CounterManagerService
{
    private $counterDirectory;

    public function __construct($counterDirectory){
        $this->counterDirectory = $counterDirectory;
    }

    public function writeZero(string $nameFile){
        $descriptionImage = [$nameFile,0];
        $stream = fopen($this->counterDirectory,'a+');
        fputcsv($stream,$descriptionImage,';',' ',"\n");
        fclose($stream);

    }

    public function counterPlus(string $nameFile){

        $file = file_get_contents($this->counterDirectory);
        if (($stream = fopen($this->counterDirectory, 'r')) !== false) {
            while (($data = fgetcsv($stream, 1000, ';', ' ', "\n"))!== false) {

                if ($data[0] === $nameFile) {
                    $strOld = implode(';',$data);
                    $data[1] += 1;
                    $strNew = implode(';',$data);
                    $file = str_replace($strOld,$strNew,$file);
                    $this->write($file);
                    break;
                }
            }
            fclose($stream);
        }
    }

    private function write($file){
        file_put_contents($this->counterDirectory,$file);
    }

    public function getCounter(string $nameFile){
        if (($stream = fopen($this->counterDirectory, 'r')) !== false) {
            while (($data = fgetcsv($stream, 1000, ';', ' ', "\n"))!== false) {
                if ($data[0] === $nameFile) {
                    return $data[1];
                }
            }
        }
        return null;
    }




}