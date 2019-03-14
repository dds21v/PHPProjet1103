<?php
namespace Generic\Controller;

use GuzzleHttp\Psr7\Response;
use Generic\Renderer\TwigRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;

abstract class Controller implements MiddlewareInterface
/**
 * Classe mère des contrôleurs PSR15 : Fournit des méthodes utilitaires
 */
{
    private $twig;
    /**__construct
     *
     * @param  mixed $twig
     *
     * @return void
     */
    public function __construct(TwigRenderer $twig)
    {
        $this->twig = $twig;
    }

    /**Retourne l'HTML 
     *
     * @param  mixed $html
     *
     * @return ResponseInterface
     */
    protected function render(string $view, array $variables = []): ResponseInterface
    {
        return new Response(200, [], $this->twig->render($view, $variables));
    }

    
}