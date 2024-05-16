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
     * @OA\Get(
     *      path="/admins/{id}",
     *      tags={"admins"},
     *      summary="Get admin by ID",
     *      security={
     *          {"ApiKey": {}}
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the admin",
     *          @OA\Schema(type="integer", format="int64")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Admin data",
     *          @OA\JsonContent(ref="#/components/schemas/Admin")
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Admin not found"
     *      )
     * )
     */
    Flight::route('GET /@id', function($id) {
        // Retrieve admin by ID from the AdminService
        $admin = Flight::get('admin_service')->getAdminById($id);
        if ($admin) {
            Flight::json($admin);
        } else {
            Flight::halt(404, "Admin not found");
        }
    });

    /**
     * @OA\Post(
     *      path="/admins/add",
     *      tags={"admins"},
     *      summary="Add a new admin",
     *      @OA\Response(
     *          response=200,
     *          description="Admin added successfully"
     *      ),
     *      @OA\RequestBody(
     *          description="Admin data",
     *          @OA\JsonContent(
     *              required={"username", "password"},
     *              @OA\Property(property="username", type="string", example="admin1"),
     *              @OA\Property(property="password", type="string", example="password123")
     *          )
     *      )
     * )
     */
    Flight::route('POST /add', function() {
        // Extract admin data from request body
        $data = Flight::request()->data->getData();

        // Call the method to add the admin
        $adminService = Flight::get('admin_service');
        $result = $adminService->addAdmin($data);

        // Return success message or error
        if ($result) {
            Flight::json(["message" => "Admin added successfully"]);
        } else {
            Flight::halt(500, "Failed to add admin");
        }
    });

    /**
     * @OA\Put(
     *      path="/admins/update/{id}",
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
     *              @OA\Property(property="username", type="string", example="admin1"),
     *              @OA\Property(property="password", type="string", example="password123")
     *          )
     *      )
     * )
     */
    Flight::route('PUT /update/@id', function($id) {
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
     *      path="/admins/delete/{id}",
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
    Flight::route('DELETE /delete/@id', function($id) {
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
