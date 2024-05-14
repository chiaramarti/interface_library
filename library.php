<?php

// Interfaccia Prestito
interface Prestito
{
    public function presta();
    public function restituisci();
}

// Classe astratta MaterialeBibliotecario che implementa l'interfaccia Prestito
abstract class MaterialeBibliotecario implements Prestito
{
    protected static $contatoreMateriali = 0;
    protected static $contatoreLibri = 0;
    protected static $contatoreDVD = 0;
}

// Sottoclasse Libro di MaterialeBibliotecario
class Libro extends MaterialeBibliotecario
{
    protected $titolo;
    private $autore;
    private $annoPubblicazione;

    public function __construct($titolo, $autore, $annoPubblicazione)
    {
        $this->titolo = $titolo;
        $this->autore = $autore;
        $this->annoPubblicazione = $annoPubblicazione;
        static::$contatoreMateriali++; // Incrementa il contatore quando un nuovo libro viene creato
        static::$contatoreLibri++;
    }

    public function presta()
    {
        if (static::$contatoreLibri > 0) {
            static::$contatoreMateriali--;
            static::$contatoreLibri--;
            echo "Materiale prestato: " . $this->titolo . "<br>\n";
        } else {
            echo "Materiale non disponibile per il prestito.<br>\n";
        }
    }

    public function restituisci()
    {
        static::$contatoreMateriali++;
        static::$contatoreLibri++;
        echo "Materiale restituito: " . $this->titolo . "<br>\n";
    }

    public static function contaLibri()
    {
        return static::$contatoreLibri;
    }
}

// Sottoclasse DVD di MaterialeBibliotecario
class DVD extends MaterialeBibliotecario
{
    protected $titolo;
    private $regista;
    private $annoPubblicazione;

    public function __construct($titolo, $regista, $annoPubblicazione)
    {
        $this->titolo = $titolo;
        $this->regista = $regista;
        $this->annoPubblicazione = $annoPubblicazione;
        static::$contatoreMateriali++; // Incrementa il contatore quando un nuovo DVD viene creato
        static::$contatoreDVD++;
    }

    public function presta()
    {
        if (static::$contatoreDVD > 0) {
            static::$contatoreMateriali--;
            static::$contatoreDVD--;
            echo "Materiale prestato: " . $this->titolo . "<br>\n";
        } else {
            echo "Materiale non disponibile per il prestito.<br>\n";
        }
    }

    public function restituisci()
    {
        static::$contatoreMateriali++;
        static::$contatoreDVD++;
        echo "Materiale restituito: " . $this->titolo . "<br>\n";
    }

    public static function contaDVD()
    {
        return static::$contatoreDVD;
    }
}

// Esempio di utilizzo
$libro1 = new Libro("Il Signore degli Anelli", "J.R.R. Tolkien", 1954);
$libro2 = new Libro("1984", "George Orwell", 1949);
$dvd1 = new DVD("Inception", "Christopher Nolan", 2010);

echo "Numero totale di libri nella biblioteca: " . Libro::contaLibri() . "<br>\n";
echo "Numero totale di DVD nella biblioteca: " . DVD::contaDVD() . "<br>\n";

$libro1->presta();
$dvd1->presta();

$libro2->presta();

$libro1->restituisci();

echo "Numero totale di libri nella biblioteca: " . Libro::contaLibri() . "<br>\n";
echo "Numero totale di DVD nella biblioteca: " . DVD::contaDVD() . "<br>\n";
