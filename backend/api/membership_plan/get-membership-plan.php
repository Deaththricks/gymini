<?php

    require_once __DIR__ . './../../includes/connection.php';
    require_once __DIR__ . './../../models/membership-plan.model.php';
    require_once __DIR__ . './../../includes/validator.php';

    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Access-Control-Allow-Headers");

    $response = [
        'status' => null,
        'message' => '',
        'data' => null,
        'errors' => null
    ];

    if($_SERVER['REQUEST_METHOD'] === "GET") {
        $id = $_GET['id'] ?? null;

        // get data by id
        if($id) {
            $membershipPlanByID = getMembershipPlanById($id, $conn);
            if($membershipPlanByID) {
                http_response_code(200);
                $response['status'] = 200;
                $response['message'] = 'OK';
                $response['data'] = $membershipPlanByID;
            } else {
                http_response_code(404); // 404 Not Found
                $respone['status'] = 404;
                $respone['message'] = "Data tidak ditemukan";
                $respone['data'] = [];
            }
        
        // get all data
        } else {
            $allMembershipPlanData = getAllMembershipPlan($conn);

             if($allMembershipPlanData) {
                http_response_code(200);
                $response['status'] = 200;
                $response['message'] = 'OK';
                $response['data'] = $allMembershipPlanData;
            } else {
                http_response_code(404); // 404 Not Found
                $respone['status'] = 200;
                $respone['message'] = "Tidak ada tidak ditemukan";
                $respone['data'] = [];
            }
        }
    } else { //method selain post
        http_response_code(405);
        $response['status'] = 405;
        $response['message'] = "Method not allowed!";
    }

    echo json_encode($response);

?>