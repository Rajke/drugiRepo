<?php 

interface Raspored
{
	public function vidiRaspored();
	public function poslednjaIzmena();	
}

class Skola
{	
	public $naziv;
	public $adresa;
	
	public function __construct($naziv,$adresa)
	{
		$this->naziv=$naziv;
		$this->adresa=$adresa;	
	}
}

class Zaposleni implements Raspored
{	
	public $ime;
	public $prezime;
	public $skola;

	public function __construct($ime, $prezime, $skola)
	{
		$this->ime=$ime;
		$this->prezime=$prezime;
		$this->skola=$skola;
	}
	public function vidiRaspored()
	{
		return "Trenutni raspored je: mat-2-3 \nsrp-2-5 \neng-5-2\n";
	}
	public function poslednjaIzmena()
	{
		return "Poslednja izmena je bila 24. 12. 2014.";
	}
		
}

class Direktor extends Zaposleni
{
	
	public function __construct($ime, $prezime, $skola)
	{
		parent::__construct($ime, $prezime, $skola);
	}
}

class Nastavnik extends Zaposleni
{
	public $predmet;

	public function __construct($ime, $prezime, $skola, $predmet)
	{
		parent::__construct($ime, $prezime, $skola);
		$this->predmet=$predmet;
		$predmet->dodaj($this);
	}
	
}

class Ucitelj extends Zaposleni
{

	public function __construct($ime, $prezime, $skola)
	{
		parent::__construct($ime, $prezime, $skola);
	}
}

class Predmet
{
	public $naziv;
	public $ucionica;
	public $nastavnici=array();
	
	public function __construct($naziv, $ucionica)
	{
		$this->naziv=$naziv;
		$this->ucionica=$ucionica;
	}

	public function dodaj($nastavnik)
	{
		array_push($this->nastavnici, $nastavnik);
	}
}

class Ucionica implements Raspored
{
	public $brSprata;
	public $naziv;

	public function __construct($brSprata, $naziv)
	{
		$this->brSprata=$brSprata;
		$this->naziv=$naziv;
	}
	public function vidiRaspored()
	{
		return "Trenutni raspored je: mat-2-3 \nsrp-2-5 \neng-5-2\n";
	}
	public function poslednjaIzmena()
	{
		return "Poslednja izmena je bila 24. 12. 2014.";
	}
}

class Ucenik implements Raspored
{
	public $ime;
	public $prezime;	
	public $razred;
	
	public function __construct($ime, $prezime, $razred)
	{
		$this->ime=$ime;
		$this->prezime=$prezime;	
		$this->razred=$razred;
	}
	public function razred()
	{
		echo $this->ime. " ".$this->prezime." ide u:   ".$this->razred->odeljenje;
	}

	public function vidiRaspored()
	{
		return "Trenutni raspored je: mat-2-3 \nsrp-2-5 \neng-5-2\n";
	}
	public function poslednjaIzmena()
	{
		return "Poslednja izmena je bila 24. 12. 2014.";
	}
}

class Razred
{
	public $odeljenje;
	public $ucitelj;
	public $ucenici=array();
	
	public function __construct($odeljenje, $uciteljica)
	{	
		$this->odeljenje=$odeljenje;
		$this->ucetiljica=$uciteljica;
	}
	public function dodaj($ucenik)
	{
		array_push($this->ucenici, $ucenik);
	}
}



$skolaNIkolaTesla= new Skola("Nikola Tesla", "Bulevar O. 55");

$ucionicaTehnicko=new Ucionica(1, "Tehnicka ucionica");

$ucionicaSrpski=new Ucionica(2, "Opsta");

$ucionicaIstorija=new Ucionica(3, "Opsta");

$direktorSvetlana= new Direktor("Svetlana", "Taskovic", $skolaNIkolaTesla);

$predmetTehnicko=new Predmet("Tehnicko obrazovanje", $ucionicaTehnicko);

$predmetSrpski=new Predmet("Srpski jezik", $ucionicaSrpski);

$nastavnikMiki= new Nastavnik("Milorad", "Milankovic",  $skolaNIkolaTesla, $predmetTehnicko);

$nastavnikBrojka= new Nastavnik("Milana", "Brojcin",  $skolaNIkolaTesla, $predmetSrpski);

$uciteljBora= new Ucitelj("Bora", "Veselinovic", $skolaNIkolaTesla);

$uciteljMarko= new Ucitelj("Marko", "Teglet", $skolaNIkolaTesla);

$razredIV2= new Razred("IV-2", $uciteljBora);

$razredVII2= new Razred("VII-2", $uciteljBora);

$ucenikPera= new Ucenik("Pera", "Peric", $razredIV2);

//echo $ucenikPera->slusaPredmet();

print_r($predmetSrpski->nastavnici);

print_r($razredIV2->ucenici);

echo $ucenikPera->vidiRaspored();





 





?>
