<?php
/**
 * Created by PhpStorm.
 * User: ubuntu
 * Date: 10/19/14
 * Time: 3:29 AM
 */

class Logger{

    private static $instance = NULL;
    private $logs;



    private function __construct()
    {
        $this->logs = array();
    }

    public static function getInstance()
    {
        
        if (self::$instance === null) {
            self::$instance = new Logger();
        }

        return self::$instance;
    }



    public function setLog($message)
    {
        if(!empty($message)) {
            $this->logs[] = $message;
        }
    }

    public function getLogs()
    {
        return $this->logs;
    }
}


class Covjek{

    protected $ime;
    protected $prezime;

    /**
     * @param mixed $ime
     */
    public function setIme($ime)
    {
        $this->ime = $ime;
    }

    /**
     * @return mixed
     */
    public function getIme()
    {
        return $this->ime;
    }

    /**
     * @param mixed $prezime
     */
    public function setPrezime($prezime)
    {
        $this->prezime = $prezime;
    }

    /**
     * @return mixed
     */
    public function getPrezime()
    {
        return $this->prezime;
    }


}

class Doktor extends Covjek{

    private $specijalnost;
    private $pacijenti;
    private $pregledi;


    public function __construct()
    {
        $logger = Logger::getInstance();
        $logger->setLog('Doktor je kreiran');
    }



    public function setPacijent($pacijent)
    {
        $this->pacijenti[]=$pacijent;
    }
    /**
     * @param mixed $pacijenti
     */
    public function setPacijenti($pacijenti)
    {
        $this->pacijenti = $pacijenti;
    }

    /**
     * @return mixed
     */
    public function getPacijenti()
    {
        return $this->pacijenti;
    }

    /**
     * @param mixed $pregledi
     */
    public function setPregledi($pregledi)
    {
        $this->pregledi = $pregledi;
    }

    /**
     * @return mixed
     */
    public function getPregledi()
    {
        return $this->pregledi;
    }



    public function zakazivanjePregleda($pacijent, $vrsta)
    {
        if('krvniPritisak' == $vrsta){
            $pregled = new KrvniPritisak();
        }elseif('secer' == $vrsta){
            $pregled = new Secer();
        }elseif('holesterol'){
            $pregled = new Holesterol();
        }
        $pregled->setPacijent($pacijent);

        $pregled->setVrsta($vrsta);


        $this->pregledi[]=$pregled;

        $logger = Logger::getInstance();
        $logger->setLog('Pregled je zakazan');

        return $pregled;


    }

    public function obavljanjePregleda($ime, $vrsta)
    {
	 
        $pronadjen=false;
        foreach ($this->pregledi as &$value) {
            if($value->getPacijent()->getIme() == $ime && $value->getVrsta()==$vrsta){
                $value->izvrsiPregled();
                $pronadjen = true;
                break;
            }
        }
        if(!$pronadjen){
            echo "Pregled nije zakazan \n";
        }
    }



    /**
     * @param mixed $specijalnost
     */
    public function setSpecijalnost($specijalnost)
    {
        $this->specijalnost = $specijalnost;
    }

    /**
     * @return mixed
     */
    public function getSpecijalnost()
    {
        return $this->specijalnost;
    }


}


class Pacijent extends Covjek{

    private $jmbg;
    private $brZdrKart;
    private $izabraniDoktor;


    public function __construct()
    {
        $logger = Logger::getInstance();
        $logger->setLog('Covjek je kreiran');
    }

    /**
     * @param mixed $izabraniDoktor
     */
    public function setIzabraniDoktor($izabraniDoktor)
    {
        if(is_null($this->izabraniDoktor)){

            $this->izabraniDoktor = $izabraniDoktor;
        }else{

            echo 'Pacijent vec ima izabranog doktora'.$this->izabraniDoktor."\n";
        }

        $logger = Logger::getInstance();
        $logger->setLog('Pacijent '.$this->ime.' je izabrao doktora '.$izabraniDoktor->getIme());
    }

    /**
     * @return mixed
     */
    public function getIzabraniDoktor()
    {
        return $this->izabraniDoktor;
    }




    /**
     * @param mixed $brZdrKart
     */
    public function setBrZdrKart($brZdrKart)
    {
        $this->brZdrKart = $brZdrKart;
    }

    /**
     * @return mixed
     */
    public function getBrZdrKart()
    {
        return $this->brZdrKart;
    }

    /**
     * @param mixed $jmbg
     */
    public function setJmbg($jmbg)
    {
        $this->jmbg = $jmbg;
    }

    /**
     * @return mixed
     */
    public function getJmbg()
    {
        return $this->jmbg;
    }

}

abstract class LaboratorijskiPregled {

    protected $datum;
    protected $vrijeme;
    protected $pacijent;
    protected $obavljen;
    protected $vrsta;
    protected $logger;
    
     public function izvrsiPregled()
    {
        $this->obavljen = true;

        $this->logger = Logger::getInstance();
        $this->logger->setLog('Laboratorijski pregled je obavljen ');
        //echo "Laboratorijski pregled je obavljen \n";
    }

    /**
     * @param mixed $vrsta
     */
    public function setVrsta($vrsta)
    {
        $this->vrsta = $vrsta;
    }

    /**
     * @return mixed
     */
    public function getVrsta()
    {
        return $this->vrsta;
    }

    /*
        public function setObavljen($obavljen)
        {
            $this->obavljen = $obavljen;
            echo 'Laboratorijski pregled je obavljen';
        }
    */

    public function getObavljen()
    {
        return $this->obavljen;
    }



    /**
     * @param mixed $pacijent
     */
    public function setPacijent($pacijent)
    {
        $this->pacijent = $pacijent;
    }

    /**
     * @return mixed
     */
    public function getPacijent()
    {
        return $this->pacijent;
    }



    /**
     * @param mixed $datum
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;
    }

    /**
     * @return mixed
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * @param mixed $vrijeme
     */
    public function setVrijeme($vrijeme)
    {
        $this->vrijeme = $vrijeme;
    }

    /**
     * @return mixed
     */
    public function getVrijeme()
    {
        return $this->vrijeme;
    }


}


class KrvniPritisak extends LaboratorijskiPregled{

    private $gornjaVrijednost;
    private $donjaVrijednost;
    private $puls;

    /**
     * @param mixed $donjaVrijednost
     */
    public function setDonjaVrijednost($donjaVrijednost)
    {
        $this->donjaVrijednost = $donjaVrijednost;
    }

    /**
     * @return mixed
     */
    public function getDonjaVrijednost()
    {
        return $this->donjaVrijednost;
    }

    /**
     * @param mixed $gornjaVrijednost
     */
    public function setGornjaVrijednost($gornjaVrijednost)
    {
        $this->gornjaVrijednost = $gornjaVrijednost;
    }

    /**
     * @return mixed
     */
    public function getGornjaVrijednost()
    {
        return $this->gornjaVrijednost;
    }

    /**
     * @param mixed $puls
     */
    public function setPuls($puls)
    {
        $this->puls = $puls;
    }

    /**
     * @return mixed
     */
    public function getPuls()
    {
        return $this->puls;
    }

    

}

class Secer extends LaboratorijskiPregled{

    private $vrijednost;
    private $vrijemePosljednjegObroka;



    /**
     * @param mixed $vrijednost
     */
    public function setVrijednost($vrijednost)
    {
        $this->vrijednost = $vrijednost;
    }

    /**
     * @return mixed
     */
    public function getVrijednost()
    {
        return $this->vrijednost;
    }

    /**
     * @param mixed $vrijemePosljednjegObroka
     */
    public function setVrijemePosljednjegObroka($vrijemePosljednjegObroka)
    {
        $this->vrijemePosljednjegObroka = $vrijemePosljednjegObroka;
    }

    /**
     * @return mixed
     */
    public function getVrijemePosljednjegObroka()
    {
        return $this->vrijemePosljednjegObroka;
    }


}


class Holesterol extends LaboratorijskiPregled{
    private $vrijednost;
    private $vrijemePosljednjegObroka;

    /**
     * @param mixed $vrijednost
     */
    public function setVrijednost($vrijednost)
    {
        $this->vrijednost = $vrijednost;
    }

    /**
     * @return mixed
     */
    public function getVrijednost()
    {
        return $this->vrijednost;
    }

    /**
     * @param mixed $vrijemePosljednjegObroka
     */
    public function setVrijemePosljednjegObroka($vrijemePosljednjegObroka)
    {
        $this->vrijemePosljednjegObroka = $vrijemePosljednjegObroka;
    }

    /**
     * @return mixed
     */
    public function getVrijemePosljednjegObroka()
    {
        return $this->vrijemePosljednjegObroka;
    }

}




$milan = new Doktor();
$milan->setIme("Milan");

$dragan = new Pacijent();
$dragan->setIme("Dragan");

$milan->setPacijent($dragan);
$dragan->setIzabraniDoktor($milan);


$pregledSecer= $milan->zakazivanjePregleda($dragan,'secer');
$pregledKrvniPritisak= $milan->zakazivanjePregleda($dragan, 'krvniPritisak');



$dragan->getIzabraniDoktor()->obavljanjePregleda($dragan->getIme(),'secer');
$dragan->getIzabraniDoktor()->obavljanjePregleda($dragan->getIme(),'krvniPritisak');


$logger = Logger::getInstance();
var_dump($logger);





