<?php

    require('database.php');

    // Get all PPMP records
    if($_POST['func'] === 'getPPMP') {
        $sql = "select * from tbl_ppmp";
        if($result = $conn->query($sql)) {
            $data = [];
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    array_push($data, $row);
                }
            }
    
            echo json_encode($data);
        } else {
            echo "Error: " . $conn->error;
        }
    }

    // Create new PPMP
    if($_POST['func'] === 'createPPMP') {
        $year = $_POST['ppmp_year'];
        $title = $_POST['ppmp_title'];
        $date_created = date('Y-m-d');
        $id = $_POST['ppmp_id'];
        $created_by = "USER";
        $save_data = [
            "'". $title ."'",
            "'". $year  ."'",
            "'". $date_created  ."'",
            "'". $created_by  ."'",
        ];
        $save_data_str = implode(',', $save_data);

        $save_columns = [
            'ppmp_title',
            'ppmp_year',
            'ppmp_date_created',
            'ppmp_created_by'
        ];
        $save_columns_str = implode(',', $save_columns);

        $update_data = [
            "ppmp_title = '". $title ."'",
            "ppmp_year = '". $year ."'",
            "ppmp_date_created = '". $date_created ."'",
            "ppmp_created_by = '". $created_by ."'"
        ];
        $update_data_str = implode(',', $update_data);

        // check if year exists
        $sql = "select * from tbl_ppmp where ppmp_year = '" . $year . "' and ppmp_id != " . $id;
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            return false;
        } else {
            if($_POST['ppmp_id'] > 0) {
                $sql = "update tbl_ppmp set " . $update_data_str . " where ppmp_id = " . $id;
            } else {
                $sql = "insert into tbl_ppmp (". $save_columns_str .") values (". $save_data_str .")";
            }

            if ($conn->query($sql) === TRUE) {
                return true;
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }

    if($_POST['func'] === 'createAct') {
        $act_ppmp_id = $_POST['act_ppmp_id'];
        $act_name = $_POST['act_name'];
        $act_fund_src_id = $_POST['act_fund_src_id'];
        $act_type = $_POST['act_type'];
        $id = $_POST['act_id'];
        $save_data = [
            "'". $act_ppmp_id ."'",
            "'". $act_name  ."'",
            "'". $act_fund_src_id  ."'",
            "'". $act_type  ."'",
        ];
        $save_data_str = implode(',', $save_data);

        $save_columns = [
            'act_ppmp_id',
            'act_name',
            'act_fund_src_id',
            'act_type'
        ];
        $save_columns_str = implode(',', $save_columns);

        $update_data = [
            "act_ppmp_id = '". $act_ppmp_id ."'",
            "act_name = '". $act_name ."'",
            "act_fund_src_id = '". $act_fund_src_id ."'",
            "act_type = '". $act_type ."'"
        ];
        $update_data_str = implode(',', $update_data);

        if($_POST['act_id'] > 0) {
            $sql = "update tbl_activity set " . $update_data_str . " where act_id = " . $id;
        } else {
            $sql = "insert into tbl_activity (". $save_columns_str .") values (". $save_data_str .")";
        }

        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error: " . $conn->error;
        }
        
    }

    // Get activities
    if($_POST['func'] === 'getActivities') {
        $sql = "select * from tbl_activity left join lib_fund_source on act_fund_src_id = id where act_ppmp_id = " . $_POST['act_ppmp_id'];
        if($result = $conn->query($sql)) {
            $data = [];
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    array_push($data, $row);
                }
            }
    
            echo json_encode($data);
        } else {
            echo "Error: " . $conn->error;
        }
    }

    // Get items
    if($_POST['func'] === 'getItems') {
        // $sql = "select * from tbl_activity left join lib_fund_source on act_fund_src_id = id where act_ppmp_id = " . $_POST['act_ppmp_id'];
        // if($result = $conn->query($sql)) {
        //     $data = [];
        //     if($result->num_rows > 0) {
        //         while($row = $result->fetch_assoc()) {
        //             array_push($data, $row);
        //         }
        //     }
    
        //     echo json_encode($data);
        // } else {
        //     echo "Error: " . $conn->error;
        // }
        return true;
    }

?>