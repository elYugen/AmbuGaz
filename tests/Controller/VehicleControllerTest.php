<?php

namespace App\Tests\Controller;

use App\Entity\Vehicle;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class VehicleControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $vehicleRepository;
    private string $path = '/vehicle/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->vehicleRepository = $this->manager->getRepository(Vehicle::class);

        foreach ($this->vehicleRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Vehicle index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'vehicle[license_plate]' => 'Testing',
            'vehicle[model]' => 'Testing',
            'vehicle[name]' => 'Testing',
            'vehicle[year_of_service]' => 'Testing',
            'vehicle[technical_inspection_date]' => 'Testing',
            'vehicle[insurance_date]' => 'Testing',
            'vehicle[company]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->vehicleRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Vehicle();
        $fixture->setLicense_plate('My Title');
        $fixture->setModel('My Title');
        $fixture->setName('My Title');
        $fixture->setYear_of_service('My Title');
        $fixture->setTechnical_inspection_date('My Title');
        $fixture->setInsurance_date('My Title');
        $fixture->setCompany('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Vehicle');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Vehicle();
        $fixture->setLicense_plate('Value');
        $fixture->setModel('Value');
        $fixture->setName('Value');
        $fixture->setYear_of_service('Value');
        $fixture->setTechnical_inspection_date('Value');
        $fixture->setInsurance_date('Value');
        $fixture->setCompany('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'vehicle[license_plate]' => 'Something New',
            'vehicle[model]' => 'Something New',
            'vehicle[name]' => 'Something New',
            'vehicle[year_of_service]' => 'Something New',
            'vehicle[technical_inspection_date]' => 'Something New',
            'vehicle[insurance_date]' => 'Something New',
            'vehicle[company]' => 'Something New',
        ]);

        self::assertResponseRedirects('/vehicle/');

        $fixture = $this->vehicleRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getLicense_plate());
        self::assertSame('Something New', $fixture[0]->getModel());
        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getYear_of_service());
        self::assertSame('Something New', $fixture[0]->getTechnical_inspection_date());
        self::assertSame('Something New', $fixture[0]->getInsurance_date());
        self::assertSame('Something New', $fixture[0]->getCompany());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Vehicle();
        $fixture->setLicense_plate('Value');
        $fixture->setModel('Value');
        $fixture->setName('Value');
        $fixture->setYear_of_service('Value');
        $fixture->setTechnical_inspection_date('Value');
        $fixture->setInsurance_date('Value');
        $fixture->setCompany('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/vehicle/');
        self::assertSame(0, $this->vehicleRepository->count([]));
    }
}
