<?php

// Set up ProductService instance
Flight::set('product_service', new ProductService());

// Group routes under '/products' endpoint
Flight::group('/products', function() {

    /**
     * @OA\Get(
     *      path="/products",
     *      tags={"products"},
     *      summary="Get all products",
     *      security={
     *          {"ApiKey": {}}
     *      },
     *      @OA\Response(
     *          response=200,
     *          description="List of products",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Product")
     *          )
     *      )
     * )
     */
    Flight::route('GET /', function() {
        // Retrieve all products from the ProductService
        $products = Flight::get('product_service')->getAllProducts();
        Flight::json($products);
    });

    /**
     * @OA\Get(
     *      path="/products/{id}",
     *      tags={"products"},
     *      summary="Get product by ID",
     *      security={
     *          {"ApiKey": {}}
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the product",
     *          @OA\Schema(type="integer", format="int64")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Product data",
     *          @OA\JsonContent(ref="#/components/schemas/Product")
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Product not found"
     *      )
     * )
     */
    Flight::route('GET /@id', function($id) {
        // Retrieve product by ID from the ProductService
        $product = Flight::get('product_service')->getProductById($id);
        if ($product) {
            Flight::json($product);
        } else {
            Flight::halt(404, "Product not found");
        }
    });

    /**
     * @OA\Post(
     *      path="/products/add",
     *      tags={"products"},
     *      summary="Add a new product",
     *      @OA\Response(
     *          response=200,
     *          description="Product added successfully"
     *      ),
     *      @OA\RequestBody(
     *          description="Product data",
     *          @OA\JsonContent(
     *              required={"name", "price"},
     *              @OA\Property(property="name", type="string", example="Product 1"),
     *              @OA\Property(property="price", type="number", example="10.99")
     *          )
     *      )
     * )
     */
    Flight::route('POST /add', function() {
        // Extract product data from request body
        $data = Flight::request()->data->getData();

        // Call the method to add the product
        $productService = Flight::get('product_service');
        $result = $productService->addProduct($data);

        // Return success message or error
        if ($result) {
            Flight::json(["message" => "Product added successfully"]);
        } else {
            Flight::halt(500, "Failed to add product");
        }
    });

    /**
     * @OA\Put(
     *      path="/products/update/{id}",
     *      tags={"products"},
     *      summary="Update product by ID",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the product to update",
     *          @OA\Schema(type="integer", format="int64")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Product updated successfully"
     *      ),
     *      @OA\RequestBody(
     *          description="Product data",
     *          @OA\JsonContent(
     *              required={"name", "price"},
     *              @OA\Property(property="name", type="string", example="Product 1"),
     *              @OA\Property(property="price", type="number", example="10.99")
     *          )
     *      )
     * )
     */
    Flight::route('PUT /update/@id', function($id) {
        // Extract product data from request body
        $data = Flight::request()->data->getData();

        // Call the method to update the product
        $productService = Flight::get('product_service');
        $result = $productService->updateProduct($id, $data);

        // Return success message or error
        if ($result) {
            Flight::json(["message" => "Product updated successfully"]);
        } else {
            Flight::halt(500, "Failed to update product");
        }
    });

    /**
     * @OA\Delete(
     *      path="/products/delete/{id}",
     *      tags={"products"},
     *      summary="Delete product by ID",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the product to delete",
     *          @OA\Schema(type="integer", format="int64")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Product deleted successfully"
     *      )
     * )
     */
    Flight::route('DELETE /delete/@id', function($id) {
        // Call the method to delete the product
        $productService = Flight::get('product_service');
        $result = $productService->deleteProduct($id);

        // Return success message or error
        if ($result) {
            Flight::json(["message" => "Product deleted successfully"]);
        } else {
            Flight::halt(500, "Failed to delete product");
        }
    });

});

?>
