<?php
namespace Resources\Behat;

use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class Symfony2Trait.
 */
trait Symfony2Trait
{
    /**
     * @var KernelInterface
     */
    protected $kernel;

    /**
     * {@inheritdoc}
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @return \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected function getContainer()
    {
        return $this->kernel->getContainer();
    }

    /**
     * @param string $id
     *
     * @return object
     */
    protected function getService($id)
    {
        return $this->getContainer()->get($id);
    }

    /**
     * Returns the Doctrine entity manager.
     *
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        return $this->getService('doctrine')->getManager();
    }

    /**
     * @return object
     */
    protected function getValidator()
    {
        return $this->getService('validator');
    }

    /**
     * @return mixed
     */
    protected function getCurrentUser()
    {
        return $this->getService('security.token_storage')->getToken()->getUser();
    }

    /**
     * @param $entity
     */
    protected function save($entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    /**
     * @param $entity
     */
    protected function delete($entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }
}
