<?php

namespace Resources\Behat;

use Behat\Gherkin\Node\TableNode;

/**
 * Behat context class.
 */
class DomainContext extends DefaultContext
{
    use CleanDbTrait;
    use LoginDomainTrait;

    /**
     * @var
     */
    protected $target;

    /**
     * @var array
     */
    private $errors = [];

    /**
     * @When I fill in:
     *
     * @param TableNode $table
     */
    public function iFillIn(TableNode $table)
    {
        foreach ($table as $row) {
            $propertySetter = 'set'.ucfirst($row['property']);
            $this->target->$propertySetter($row['value']);
        }
    }

    /**
     * @Transform :setProperty
     *
     * @param $propertyName
     *
     * @return string
     */
    public function transformPropertyNameIntoSetter($propertyName)
    {
        return 'set'.str_replace(' ', '', $propertyName);
    }

    /**
     * @Transform :getProperty
     *
     * @param $propertyName
     *
     * @return string
     */
    public function transformPropertyNameIntoGetter($propertyName)
    {
        return 'get'.str_replace(' ', '', $propertyName);
    }

    /**
     * @Given I save changes
     */
    public function iSaveChanges()
    {
        $this->validateAndSave($this->target);
    }

    /**
     * @When     I fill :setProperty with :propertyValue
     *
     * @param $setProperty
     * @param $propertyValue
     */
    public function iFillWith($setProperty, $propertyValue)
    {
        $this->target->$setProperty($propertyValue);
    }

    /**
     * @Then field :getProperty should be :propertyValue
     *
     * @param $getProperty
     * @param $propertyValue
     */
    public function fieldShouldBe($getProperty, $propertyValue)
    {
        \PHPUnit_Framework_Assert::assertSame($this->target->$getProperty(), $propertyValue);
    }

    /**
     * @param       $entity
     * @param array $validationGroup
     */
    protected function validateAndSave($entity, array $validationGroup = ['Default'])
    {
        $errors = $this->getValidator()->validate($entity, null, $validationGroup);

        if (count($errors) > 0) {
            $this->processErrors($errors);
        } else {
            $this->save($entity);
        }
    }

    /**
     * @param string $property
     * @param string $message
     *
     * @throws \Exception
     *
     * @return bool
     */
    protected function assertHasValidationError($property, $message)
    {
        if (!$this->hasError($property, $message)) {
            throw new \Exception('Missing validation error:'.$message);
        }
    }

    /**
     * @param string $property
     * @param string $message
     *
     * @return bool
     */
    protected function hasError($property, $message)
    {
        //Checking if error key exists
        if (!array_key_exists($property, $this->errors)) {
            return false;
        }

        //Checking messages are same.
        if ($this->errors[$property] !== $message) {
            return false;
        }

        return true;
    }

    /**
     * Transfers validation errors.
     *
     * @param $errors
     */
    private function processErrors($errors)
    {
        foreach ($errors as $error) {
            $this->errors[$error->getPropertyPath()] = $error->getMessage();
        }
    }

    /**
     * @return array
     */
    protected function getErrors()
    {
        return $this->errors;
    }
}
