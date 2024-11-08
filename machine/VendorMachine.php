<?php


//On créé la classe "VendorMachine"
class VendorMachine
{
    public $snacks; //Snacks de notre machine
    public $cashAmount; //Cash de notre machine
    public $isOn; //Booléen qui indique si la machine est éteinte ou allumée


    //Constructeur de la classe
    public function __construct() {

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
            ],
            [
            "name" => "Banane",   //J'ai rendu le distributeur un peu "healthy"
            "price" => 1,
            "quantity" => 5
        ]
        ];
        $this->cashAmount = 0; //Met le cash de la machine à 0
        $this->isOn = true; //La machine commence par l'état "éteinte"
    }

    //Méthode pour allumer la machine
    public function turnOn()
    {
        $this->isOn = true;
    }
//Méthode pour éteindre la machine
    public function turnOff()
    {
        $currentDate = new DateTime();//Initialisation a l'heure actuelle
        $currentHour = $currentDate->format("H");


        if ($currentHour >= 10) {
            $this->isOn = false;
        } else {
            throw new Exception('Vous ne pouvez pas éteindre la machine avant 18h');
        }
    }


    //Méthode pour acheter un snack
    public function buySnack($snackName)
    {

        //On verifie si la machine est allumée
        if (!$this->isOn) {
            echo "La machine est éteinte. ";
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
                    echo "Vous avez acheté un {$snackName}. Montant payé : {$snack['price']}€ ! ";
                    return;
                } else {
                    echo "Désolé, {$snackName} n'est plus disponible. ";
                    return;
                }
            }
        }

        echo "Snack non trouvé. ";
    }
//Methode pour mettre un coup de pied dans la machine
    public function shootWithFoot()
    {

        //On verifie si la machine est allumée
        if (!$this->isOn) {
            echo "La machine est éteinte. ";
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
        //mt_rand genere un nombre entier aléatoire plus rapide que rand()
        //on choisis un nombre entre 0 et -->
        //$this->>cashAmount * 100 on multiplie "cashAmount par 100 pour le convertir en centimes.
        //Ensuite on divise le nombre entier du résultat précedent par 100 pour avoir un montant aléatoire entre 0 et $cashAmount.
        $randomCash = mt_rand(0, $this->cashAmount * 100) / 100;

        //Soustraction du montant au total de cash
        $this->cashAmount -= $randomCash;

        echo "Un {$randomSnack['name']} est tombé ! Et {$randomCash}€ sont sortis de la machine.";
    }
}


$machine = new VendorMachine();
$machine->turnOn();
$machine->buySnack("Banane");
$machine->shootWithFoot();
$machine->turnOff();