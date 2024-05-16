<?php

// Include the AdminService class
require_once __DIR__ . '/../services/AdminService.class.php';

// Set up AdminService instance
Flight::set('admin_service', new AdminService());

// Group routes under '/admins' endpoint
Flight::group('/admins', function() {

    /**
     * @OA\Get(
     *      path="/admins",
     *      tags={"admins"},
     *      summary="Get all admins",
     *      security={
     *          {"ApiKey": {}}
     *      },
     *      @OA\Response(
     *          response=200,
     *          description="List of admins",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Admin")
     *          )
     *      )
     * )
     */
    Flight::route('GET /', function() {
        // Retrieve all admins from the AdminService
        $admins = Flight::get('admin_service')->getAllAdmins();
        Flight::json($admins);
    });

    /**
     * @OA\Post(
     *      path="/admins",
     *      tags={"admins"},
     *      summary="Create a new admin",
     *      @OA\Response(
     *          response=200,
     *          description="Admin created successfully"
     *      ),
     *      @OA\RequestBody(
     *          description="Admin data",
     *          @OA\JsonContent(
     *              required={"username", "password"},
     *              @OA\Property(property="username", type="string", example="admin"),
     *              @OA\Property(property="password", type="string", example="password")
     *          )
     *      )
     * )
     */
    Flight::route('POST /', function() {
        // Extract admin data from request body
        $data = Flight::request()->data->getData();

        // Call the method to create the admin
        $adminService = Flight::get('admin_service');
        $result = $adminService->createAdmin($data);

        // Return success message or error
        if ($result) {
            Flight::json(["message" => "Admin created successfully"]);
        } else {
            Flight::halt(500, "Failed to create admin");
        }
    });

    /**
     * @OA\Put(
     *      path="/admins/{id}",
     *      tags={"admins"},
     *      summary="Update admin by ID",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the admin to update",
     *          @OA\Schema(type="integer", format="int64")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Admin updated successfully"
     *      ),
     *      @OA\RequestBody(
     *          description="Admin data",
     *          @OA\JsonContent(
     *              required={"username", "password"},
     *              @OA\Property(property="username", type="string", example="admin"),
     *              @OA\Property(property="password", type="string", example="password")
     *          )
     *      )
     * )
     */
    Flight::route('PUT /@id', function($id) {
        // Extract admin data from request body
        $data = Flight::request()->data->getData();

        // Call the method to update the admin
        $adminService = Flight::get('admin_service');
        $result = $adminService->updateAdmin($id, $data);

        // Return success message or error
        if ($result) {
            Flight::json(["message" => "Admin updated successfully"]);
        } else {
            Flight::halt(500, "Failed to update admin");
        }
    });

    /**
     * @OA\Delete(
     *      path="/admins/{id}",
     *      tags={"admins"},
     *      summary="Delete admin by ID",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the admin to delete",
     *          @OA\Schema(type="integer", format="int64")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Admin deleted successfully"
     *      )
     * )
     */
    Flight::route('DELETE /@id', function($id) {
        // Call the method to delete the admin
        $adminService = Flight::get('admin_service');
        $result = $adminService->deleteAdmin($id);

        // Return success message or error
        if ($result) {
            Flight::json(["message" => "Admin deleted successfully"]);
        } else {
            Flight::halt(500, "Failed to delete admin");
        }
    });

});

?>
