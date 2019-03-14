<?php
namespace Generic\Renderer;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Classe permettant de simplifier l'usage de TWIG
 */
class TwigRenderer
{
    private $twig;

    /**Initialise TWIG
     * @param string $path - chemin du dossier des vues
     */
    public function __construct(string $path)
    {
        $loader = new FilesystemLoader($path);
        $this->twig = new Environment($loader, [
            'cache' => false
        ]);
    }
    
    /**rendre une vue TWIG (fichier avec extension ".twig") dans une chaine de charactères
     * @param  mixed $view
     * @param  mixed $variables
     * @return string
     */
    public function render(string $view, array $variables = []): string
    {
        return $this->twig->render($view, $variables);
    }
}