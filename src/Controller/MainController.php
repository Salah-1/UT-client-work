<?php
// src/Controller/MainController.php
namespace App\Controller;

use App\Entity\Shortener;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType; 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;



use Symfony\Component\Validator\Validator\ValidatorInterface;
//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends Controller
{
/**
 *  Responsible for the / action 
 */
    public function homeP(Request $request, ValidatorInterface $validator)
    {

      // form builder
      $form = $this->createFormBuilder()
        ->add('URL', TextType::class, [
            'label'=> 'URL ',
            'required' => true,
            'attr' => [
                'class'=> 'xyz'
                ]
                ])
        ->add('submit', SubmitType::class, [
            'label' => 'Shorten the URL',
            'attr'  => [
                'class' => 'btn btn-primary'
            ]
        ])
        ->getForm();

        // handle the submission 
        $form->handleRequest($request);
        // no time for Symfony validators use php validators for now

        $url = $form->getData()['URL'];

        if (filter_var($url, FILTER_VALIDATE_URL) === FALSE && !empty($url)) {
            die('Not a valid URL, hit Back');
           
        }

       

        if ($form->isSubmitted() && $form->isValid()) {

            $url = $form->getData()['URL'];
            $random = random_bytes(5);
            $shortenLink = bin2hex($random);

            // prepare obj and save to db 
            $entityManager = $this->getDoctrine()->getManager();

            $shortenerObj = new Shortener();
            $shortenerObj->setOriginalUrl($url);
            $shortenerObj->setShortenLink($shortenLink);

            // want save it
            $entityManager->persist($shortenerObj);
            $entityManager->flush();

            //return new Response('Saved new shortened URL with id '.$shortenerObj->getId());
             
            return new Response(
                '<p>Success, submitted link::: '.$url.'</p>'.
                '<p>Shorten version is::: http://ut.com/'.$shortenLink.'</p>'.
                '<p> Saved new shortened URL with id '.$shortenerObj->getId().'</p>'
            );
        }

        return $this->render('urlshortener/homep.html.twig', [
            'form' => $form->createView(),
        ]);
        
    }
    /**
    *  Responsible for the linkInfo action 
    */
    public function linkInfo(Request $request) {
        //sanity check 
        $time = new \DateTime();
        $time = $time->format('m-d-Y H:i:s');
        

        //return new Response( var_dump($request->get('id')));
        $id = intval($request->get('id'));

        if(is_int ( $id)) {
           // $id = $request->get('id');

            $repository = $this->getDoctrine()->getRepository(Shortener::class);
            $allURLs = $repository->findAll();
            $singleItem = $repository->find($id);

        return $this->render('urlshortener/info.html.twig', array('data' => $singleItem ));

        }

        else {
            return new response ('Imporper ID given in the URL');
        }

         
                 
    }

    /**
    *  Responsible for the redirect action 
    */
public function redirectLink() {

  }

   
}   // End Controller 