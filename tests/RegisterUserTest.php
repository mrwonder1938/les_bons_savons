<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterUserTest extends WebTestCase
{
    public function testSomething(): void
    {
        //1 creaction d'un faux client de pointer vers un navigateur vers une URL
        //2 rempli les champs de mon fomr d'inscription
        //3 verifie si j'ai un message (alerte))
        
        //1
        $client = static::createClient();
        $crawler = $client->request('GET', '/inscription');
        
        //2 (email, password, confirm password,firstname, et lastname)
        $client->submitForm('valider' ,[
        'register_user[email]'=>'jake@email',
        'register_user[password][first]'=> '12345678',
         'register_user[password][second]'=> '12345678',
         'register_user[firstname]'=> 'jake',
         'register_user[lastname]'=> 'BEN'
        ]);

        //suivre redirection
        $client->followRedirect();

        //3
        $this->assertResponseRedirects('/connexion');
        $this->assertSelectorExists('div:contains["ton compte est cree")');
    }
}
