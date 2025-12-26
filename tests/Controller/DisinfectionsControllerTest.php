<?php

namespace App\Tests\Controller;

use App\Entity\Disinfections;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class DisinfectionsControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $disinfectionRepository;
    private string $path = '/disinfections/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->disinfectionRepository = $this->manager->getRepository(Disinfections::class);

        foreach ($this->disinfectionRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Disinfection index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'disinfection[date]' => 'Testing',
            'disinfection[disinfectionType]' => 'Testing',
            'disinfection[vehicle]' => 'Testing',
            'disinfection[user]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->disinfectionRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Disinfections();
        $fixture->setDate('My Title');
        $fixture->setDisinfectionType('My Title');
        $fixture->setVehicle('My Title');
        $fixture->setUser('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Disinfection');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Disinfections();
        $fixture->setDate('Value');
        $fixture->setDisinfectionType('Value');
        $fixture->setVehicle('Value');
        $fixture->setUser('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'disinfection[date]' => 'Something New',
            'disinfection[disinfectionType]' => 'Something New',
            'disinfection[vehicle]' => 'Something New',
            'disinfection[user]' => 'Something New',
        ]);

        self::assertResponseRedirects('/disinfections/');

        $fixture = $this->disinfectionRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getDate());
        self::assertSame('Something New', $fixture[0]->getDisinfectionType());
        self::assertSame('Something New', $fixture[0]->getVehicle());
        self::assertSame('Something New', $fixture[0]->getUser());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Disinfections();
        $fixture->setDate('Value');
        $fixture->setDisinfectionType('Value');
        $fixture->setVehicle('Value');
        $fixture->setUser('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/disinfections/');
        self::assertSame(0, $this->disinfectionRepository->count([]));
    }
}
