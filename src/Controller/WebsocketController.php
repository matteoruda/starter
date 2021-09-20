<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/websocket", name="websocket")
 */
class WebsocketController extends AbstractController
{
    /**
     * @Route("/", name="chat")
     */
    public function index()
    {
        return $this->render('websocket/index.html.twig', [
            'controller_name' => 'WebsocketController',
        ]);
    }

    /**
     * @Route("/command", name="command")
     */
    public function command(KernelInterface $kernel)
    {
        $php = (new PhpExecutableFinder())->find();
        $phpFinder = str_replace('-cgi', '', $php);
        $command = $phpFinder.' '.$kernel->getProjectDir().'/bin/console ' . 'run:websocket-server';

        if(PHP_OS_FAMILY === "Windows") {
            pclose(popen("start /B ". $command, "r"));
        }
        if(PHP_OS_FAMILY === "Linux"){
            $command .=  " > /dev/null 2>&1 &";
            shell_exec($command);
        }

        // return new Response(""), if you used NullOutput()
        return new Response($command);
    }
}
