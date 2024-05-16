<?php

// Include the CustomerService class
require_once __DIR__ . '/../services/CustomerService.class.php';

use Firebase\JWT\JWT; // Import JWT class
use Firebase\JWT\Key; // Import Key class

// Set up CustomerService instance
Flight::set('customer_service', new CustomerService());

// Group routes under '/customers' endpoint
Flight::group('/customers', function() {

    /**
     * @OA\Get(
     *      path="/customers",
     *      tags={"customers"},
     *      summary="Get all customers",
     *      security={
     *          {"ApiKey": {}}
     *      },
     *      @OA\Response(
     *          response=200,
     *          description="List of customers",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Customer")
     *          )
     *      )
     * )
     */
    Flight::route('GET /', function() {
        // Retrieve all customers from the CustomerService
        $customers = Flight::get('customer_service')->getAllCustomers();
        Flight::json($customers);
    });

    /**
     * @OA\Get(
     *      path="/customers/{id}",
     *      tags={"customers"},
     *      summary="Get customer by ID",
     *      security={
     *          {"ApiKey": {}}
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the customer",
     *          @OA\Schema(type="integer", format="int64")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Customer data",
     *          @OA\JsonContent(ref="#/components/schemas/Customer")
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Customer not found"
     *      )
     * )
     */
    Flight::route('GET /@id', function($id) {
        // Retrieve customer by ID from the CustomerService
        $customer = Flight::get('customer_service')->getCustomerById($id);
        if ($customer) {
            Flight::json($customer);
        } else {
            Flight::halt(404, "Customer not found");
        }
    });

    /**
     * @OA\Post(
     *      path="/customers/add",
     *      tags={"customers"},
     *      summary="Add a new customer",
     *      @OA\Response(
     *          response=200,
     *          description="Customer added successfully"
     *      ),
     *      @OA\RequestBody(
     *          description="Customer data",
     *          @OA\JsonContent(
     *              required={"name", "surname", "email", "phone", "address"},
     *              @OA\Property(property="name", type="string", example="John"),
     *              @OA\Property(property="surname", type="string", example="Doe"),
     *              @OA\Property(property="email", type="string", example="john.doe@example.com"),
     *              @OA\Property(property="phone", type="string", example="1234567890"),
     *              @OA\Property(property="address", type="string", example="123 Street, City")
     *          )
     *      )
     * )
     */
    Flight::route('POST /add', function() {
        // Extract customer data from request body
        $data = Flight::request()->data->getData();

        // Call the method to add the customer
        $customerService = Flight::get('customer_service');
        $result = $customerService->addCustomer($data);

        // Return success message or error
        if ($result) {
            Flight::json(["message" => "Customer added successfully"]);
        } else {
            Flight::halt(500, "Failed to add customer");
        }
    });

    /**
     * @OA\Put(
     *      path="/customers/update/{id}",
     *      tags={"customers"},
     *      summary="Update customer by ID",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the customer to update",
     *          @OA\Schema(type="integer", format="int64")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Customer updated successfully"
     *      ),
     *      @OA\RequestBody(
     *          description="Customer data",
     *          @OA\JsonContent(
     *              required={"name", "surname", "email", "phone", "address"},
     *              @OA\Property(property="name", type="string", example="John"),
     *              @OA\Property(property="surname", type="string", example="Doe"),
     *              @OA\Property(property="email", type="string", example="john.doe@example.com"),
     *              @OA\Property(property="phone", type="string", example="1234567890"),
     *              @OA\Property(property="address", type="string", example="123 Street, City")
     *          )
     *      )
     * )
     */
    Flight::route('PUT /update/@id', function($id) {
        // Extract customer data from request body
        $data = Flight::request()->data->getData();

        // Call the method to update the customer
        $customerService = Flight::get('customer_service');
        $result = $customerService->updateCustomer($id, $data);

        // Return success message or error
        if ($result) {
            Flight::json(["message" => "Customer updated successfully"]);
        } else {
            Flight::halt(500, "Failed to update customer");
        }
    });

    /**
     * @OA\Delete(
     *      path="/customers/delete/{id}",
     *      tags={"customers"},
     *      summary="Delete customer by ID",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the customer to delete",
     *          @OA\Schema(type="integer", format="int64")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Customer deleted successfully"
     *      )
     * )
     */
    Flight::route('DELETE /delete/@id', function($id) {
        // Call the method to delete the customer
        $customerService = Flight::get('customer_service');
        $result = $customerService->deleteCustomer($id);

        // Return success message or error
        if ($result) {
            Flight::json(["message" => "Customer deleted successfully"]);
        } else {
            Flight::halt(500, "Failed to delete customer");
        }
    });

});

?>
