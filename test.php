<?php

use Advox\Employees\Api\Data\EmployeeInterface;
use Advox\Employees\Api\Data\EmployeeInterfaceFactory;
use Advox\Employees\Api\EmployeeRepositoryInterface;
use Advox\Employees\Model\EmployeeRepository;
use Advox\Employees\Model\ResourceModel\Employee;
use Magento\Backend\App\Area\FrontNameResolver;
use Magento\Framework\App\Bootstrap;
use Magento\Framework\Api\SearchCriteriaBuilder;

require __DIR__ . '/app/bootstrap.php';
ini_set('display_errors', '1');
error_reporting(E_ALL | E_STRICT);
$bootstrap = Bootstrap::create(BP, $_SERVER);
$obj = $bootstrap->getObjectManager();

/** @var Magento\Framework\App\State $state */
$state = $obj->get(\Magento\Framework\App\State::class);
$state->setAreaCode(\Magento\Framework\App\Area::AREA_FRONTEND);

/** @var EmployeeRepositoryInterface $repo */
$repo = $obj->get('Advox\Employees\Api\EmployeeRepositoryInterface');


$employeeFactory = $obj->get(EmployeeInterfaceFactory::class);
$employee = $employeeFactory->create();
//$employee->setData($data);

$employee->setName("fofdssdfdo1");
$repo->save($employee);


//$emx = $repo->getById(1236);



die;
$search_criteria = $obj
    ->create('Magento\Framework\Api\SearchCriteriaBuilder')
    ->addFilter('id','1')
//->addFilter('sku','WSH11-28%Blue', 'like') //additional addFilters will
    //add another group
    ->create();

$x = $repo->getList($search_criteria);

foreach($x->getItems() as $item) {
    var_dump($item->getData());
}

//var_dump($emx->getId());
//$repo->deleteById(1232);

//$repo->save($employee);

//$repo->getById();

/** @var  EmployeeInterfaceFactory $employeeFactory */
//$employeeFactory = $obj->get(EmployeeInterfaceFactory::class);
//$employeeResourceModel = $obj->get(Employee::class);

//$repo = new EmployeeRepository($employeeResourceModel, $employeeFactory);

/** @var EmployeeInterface $employee */
/*$employee = $employeeFactory->create();
$employee->setData($data);

$employee->setName("foo");
$employee->save();

var_dump($employee->getData());*/
