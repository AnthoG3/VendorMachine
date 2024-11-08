<?php


//On créé la classe "VendorMachine"
class VendorMachine
{
    private $snacks; //Snacks de notre machine
    private $cashAmount; //Cash de notre machine
    private $isOn; //Booléen qui indique si la machine est éteinte ou allumée


    //Constructeur de la classe
    public function __construct()
    {

        //Mise en place du tableau des snacks
        $this->snacks = [
            [
                "name" => "Snickers",
                "price" => 1,
                "quantity" => 5
            ],
            [
                "name" => "Mars",
                "price" => 1.5,
                "quantity" => 5
            ],
            [
                "name" => "Twix",
                "price" => 2,
                "quantity" => 5
            ],
            [
                "name" => "Bounty",
                "price" => 2.5,
                "quantity" => 5
            ]
        ];
        $this->cashAmount = 0; //Départ du montant de cash a 0
        $this->isOn = false; //La machine commence par l'état "éteinte"
    }

    //Méthode pour allumer la machine
    public function turnOn()
    {
        $this->isOn = true;
    }
//Méthode pour éteindre la machine
    public function turnOff()
    {
        $currentHour = (int) date('H'); //Initialisation a l'heure actuelle
        if ($currentHour >= 18) {  //Boucle qui permet de savoir si il est 18h ou plus
            $this->isOn = false;
        } else {
            echo "La machine ne peut pas être éteinte avant 18h.\n";
        }
    }

    //Méthode pour acheter un snack
    public function buySnack($snackName)
    {

        //On verifie si la machine est allumée
        if (!$this->isOn) {
            echo "La machine est éteinte.";
            return;
        }
//On parcours le tableau des snacks
        foreach ($this->snacks as &$snack) {
            if ($snack['name'] === $snackName) {

                //On verifie si le snack est disponible
                if ($snack['quantity'] > 0) {

                    //Décrementation de la quantité
                    $snack['quantity']--;

                    //Ajout du prix au montant total
                    $this->cashAmount += $snack['price'];
                    echo "Vous avez acheté un {$snackName}. Montant payé : {$snack['price']}€";
                    return;
                } else {
                    echo "Désolé, {$snackName} n'est plus disponible.";
                    return;
                }
            }
        }

        echo "Snack non trouvé.";
    }
//Methode pour mettre un coup de pied dans la machine
    public function shootWithFoot()
    {

        //On verifie si la machine est allumée
        if (!$this->isOn) {
            echo "La machine est éteinte.";
            return;
        }

        //Filtrage des snacks disponibles
        $availableSnacks = array_filter($this->snacks, function($snack) {
            return $snack['quantity'] > 0;
        });

        //Vérification des snacks disponibles
        if (empty($availableSnacks)) {
            echo "Pas de snacks disponibles.";
            return;
        }

        //Sélection aléatoire d'un snack disponible
        $randomSnack = $availableSnacks[array_rand($availableSnacks)];
        $randomSnack['quantity']--;

        //Un montant aléatoire de cash tombe de la machine
        $randomCash = mt_rand(0, min(100, $this->cashAmount * 100)) / 100;

        //Soustraction du montant au total de cash
        $this->cashAmount -= $randomCash;

        echo "Un {$randomSnack['name']} est tombé ! Et {$randomCash}€ sont sortis de la machine.";
    }

    //Retourne le tableau des snacks
    public function getSnacks()
    {
        return $this->snacks;
    }

    //Retourne le montant d'argent dans la machine
    public function getCashAmount()
    {
        return $this->cashAmount;
    }
//Retourne si la machien est sur on ou off
    public function isOn()
    {
        return $this->isOn;
    }
}


$machine = new VendorMachine();
$machine->turnOn();
$machine->buySnack("Mars");
$machine->shootWithFoot();
$machine->turnOff();