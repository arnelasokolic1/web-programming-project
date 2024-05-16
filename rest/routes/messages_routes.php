<?php

// Include the MessageService class
require_once __DIR__ . '/../services/ContactMessageService.class.php';

// Set up MessageService instance
Flight::set('message_service', new MessageService());

// Group routes under '/messages' endpoint
Flight::group('/messages', function() {

    /**
     * @OA\Get(
     *      path="/messages",
     *      tags={"messages"},
     *      summary="Get all messages",
     *      security={
     *          {"ApiKey": {}}
     *      },
     *      @OA\Response(
     *          response=200,
     *          description="List of messages",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Message")
     *          )
     *      )
     * )
     */
    Flight::route('GET /', function() {
        // Retrieve all messages from the MessageService
        $messages = Flight::get('message_service')->getAllMessages();
        Flight::json($messages);
    });

    /**
     * @OA\Get(
     *      path="/messages/{id}",
     *      tags={"messages"},
     *      summary="Get message by ID",
     *      security={
     *          {"ApiKey": {}}
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the message",
     *          @OA\Schema(type="integer", format="int64")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Message data",
     *          @OA\JsonContent(ref="#/components/schemas/Message")
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Message not found"
     *      )
     * )
     */
    Flight::route('GET /@id', function($id) {
        // Retrieve message by ID from the MessageService
        $message = Flight::get('message_service')->getMessageById($id);
        if ($message) {
            Flight::json($message);
        } else {
            Flight::halt(404, "Message not found");
        }
    });

    /**
     * @OA\Post(
     *      path="/messages/add",
     *      tags={"messages"},
     *      summary="Add a new message",
     *      @OA\Response(
     *          response=200,
     *          description="Message added successfully"
     *      ),
     *      @OA\RequestBody(
     *          description="Message data",
     *          @OA\JsonContent(
     *              required={"content", "sender_id", "receiver_id"},
     *              @OA\Property(property="content", type="string", example="Hello, how are you?"),
     *              @OA\Property(property="sender_id", type="integer", example="1"),
     *              @OA\Property(property="receiver_id", type="integer", example="2")
     *          )
     *      )
     * )
     */
    Flight::route('POST /add', function() {
        // Extract message data from request body
        $data = Flight::request()->data->getData();

        // Call the method to add the message
        $messageService = Flight::get('message_service');
        $result = $messageService->addMessage($data);

        // Return success message or error
        if ($result) {
            Flight::json(["message" => "Message added successfully"]);
        } else {
            Flight::halt(500, "Failed to add message");
        }
    });

    /**
     * @OA\Put(
     *      path="/messages/update/{id}",
     *      tags={"messages"},
     *      summary="Update message by ID",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the message to update",
     *          @OA\Schema(type="integer", format="int64")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Message updated successfully"
     *      ),
     *      @OA\RequestBody(
     *          description="Message data",
     *          @OA\JsonContent(
     *              required={"content"},
     *              @OA\Property(property="content", type="string", example="New message content")
     *          )
     *      )
     * )
     */
    Flight::route('PUT /update/@id', function($id) {
        // Extract message data from request body
        $data = Flight::request()->data->getData();

        // Call the method to update the message
        $messageService = Flight::get('message_service');
        $result = $messageService->updateMessage($id, $data);

        // Return success message or error
        if ($result) {
            Flight::json(["message" => "Message updated successfully"]);
        } else {
            Flight::halt(500, "Failed to update message");
        }
    });

    /**
     * @OA\Delete(
     *      path="/messages/delete/{id}",
     *      tags={"messages"},
     *      summary="Delete message by ID",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the message to delete",
     *          @OA\Schema(type="integer", format="int64")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Message deleted successfully"
     *      )
     * )
     */
    Flight::route('DELETE /delete/@id', function($id) {
        // Call the method to delete the message
        $messageService = Flight::get('message_service');
        $result = $messageService->deleteMessage($id);

        // Return success message or error
        if ($result) {
            Flight::json(["message" => "Message deleted successfully"]);
        } else {
            Flight::halt(500, "Failed to delete message");
        }
    });

});

?>
