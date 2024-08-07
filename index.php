<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php require_once('database.php') ?>

    <div class="container">
        <div class="row">
            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#ppmp_modal" onclick="clearPPMP()">New PPMP</button>
        </div><br/>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>PPMP Title</th>
                            <th>Year</th>
                            <th>Date Created</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="ppmp_rows">
                    </tbody>
                </table>
            </div>
        </div>

        <!-- modals -->
        <div class="modal fade" id="ppmp_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">PPMP</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="ppmp_id" id="ppmp_id">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="ppmp_title">Title</label>
                                <textarea class="form-control" name="ppmp_title" id="ppmp_title" required></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="ppmp_year">Year</label>
                                <input type="text" class="form-control" name="ppmp_year" id="ppmp_year" required></input>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" id="create_ppmp_btn" type="button">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="acts_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">PPMP Activities</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#save_acts_modal">New Activity</button>
                        </div><br/>
                        <div class="row">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Activity Name</th>
                                        <th>Fund Source</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="acts_rows"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
            $sql = 'select * from lib_fund_source';
            $fund_sources = [];
            if($result = $conn->query($sql)) {
                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        array_push($fund_sources, $row);
                    }
                }
            } else {
                echo "Error: Unable to fetch data";
            }
        ?>
        <div class="modal fade" id="save_acts_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Activity</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="act_ppmp_id" id="act_ppmp_id">
                        <input type="hidden" name="act_id" id="act_id">
                        <div class="row">
                            <label for="">Activity Name</label>
                            <textarea class="form-control" name="act_name" id="act_name"></textarea>
                        </div>
                        <div class="row">
                            <label for="">Fund Source</label>
                            <select name="act_fund_src_id" id="act_fund_src_id">
                                <?php foreach($fund_sources as $source): ?>
                                    <option value="<?= $source['id'] ?>"><?= $source['fund_source'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="row">
                            <label for="">Type</label>
                            <input type="text" name="act_type" id="act_type" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" id="create_act_btn" type="button">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="items_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Activity Items</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#save_items_modal">New Item</button>
                        </div><br/>
                        <div class="row">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>Unit Cost</th>
                                        <th>UACS Code</th>
                                    </tr>
                                </thead>
                                <tbody id="items_rows"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        let ppmp_list = [];
        $(document).ready(function() {
            $.ajax({
                url: 'controller.php',
                type: 'POST',
                data: {
                    func: 'getPPMP',
                },
                success: function(res) {
                    let data = $.parseJSON(res);
                    ppmp_list = data;
                    // append data to table
                    for(let i = 0; i < data.length; i++) {
                        let rows = '';
                        rows += "<tr>";
                        
                        // title
                        rows += "<td>";
                        rows += data[i].ppmp_title;
                        rows += "</td>";
                        // year
                        rows += "<td>";
                        rows += data[i].ppmp_year;
                        rows += "</td>";
                        // date created
                        rows += "<td>";
                        rows += data[i].ppmp_date_created;
                        rows += "</td>";
                        // created by
                        rows += "<td>";
                        rows += data[i].ppmp_created_by;
                        rows += "</td>";
                        //action
                        rows += '<td><button type="button" class="btn btn-warning" id="update_ppmp_btn" onclick="updatePPMP('+i+')">Update</button>\
                            <button type="button" class="btn btn-info" id="open_acts_btn" onclick="openActivities('+i+')">Activities</button></td>';

                        rows += "</tr>";

                        $('#ppmp_rows').append(rows);
                    }
                    
                }
            });

            
        });

        $('#create_ppmp_btn').click(function() {
            let ppmp_title = $('#ppmp_title').val();
            let ppmp_year = $('#ppmp_year').val();
            let ppmp_id = null;
            if($('#ppmp_id').val() > 0)
                ppmp_id = $('#ppmp_id').val();
            $.ajax({
                url: 'controller.php',
                type: 'POST',
                data: {
                    func: 'createPPMP',
                    ppmp_title: ppmp_title,
                    ppmp_year: ppmp_year,
                    ppmp_id: ppmp_id,
                },
                success: function(res) {
                    location.reload();
                }
            });
        }); 

        $('#create_act_btn').click(function() {
            let act_ppmp_id = $('#act_ppmp_id').val();
            let act_name = $('#act_name').val();
            let act_fund_src_id = $('#act_fund_src_id').val();
            let act_type = $('#act_type').val();
            let act_id = null;
            if($('#act_id').val() > 0)
                act_id = $('#act_id').val();
            $.ajax({
                url: 'controller.php',
                type: 'POST',
                data: {
                    func: 'createAct',
                    act_ppmp_id: act_ppmp_id,
                    act_name: act_name,
                    act_fund_src_id: act_fund_src_id,
                    act_type: act_type,
                    act_id: act_id,
                },
                success: function(res) {
                    location.reload();
                }
            });
        })

        function updatePPMP(index) {
            let data = ppmp_list[index];
            $('#ppmp_title').val(data.ppmp_title);
            $('#ppmp_year').val(data.ppmp_year);
            $('#ppmp_id').val(data.ppmp_id);
            $('#ppmp_modal').modal('toggle');
        }

        function clearPPMP() {
            $('#ppmp_title').val('');
            $('#ppmp_year').val('');
            $('#ppmp_id').val('');
        }

        function openActivities(ppmp_index) {
            $.ajax({
                url: 'controller.php',
                type: 'POST',
                data: {
                    func: 'getActivities',
                    act_ppmp_id: ppmp_list[ppmp_index].ppmp_id
                },
                success: function(res) {
                    let data = $.parseJSON(res);
                    $('#acts_rows').empty();
                    // append data to table
                    for(let i = 0; i < data.length; i++) {
                        let rows = '';
                        rows += "<tr>";
                        
                        // activity name
                        rows += "<td>";
                        rows += data[i].act_name;
                        rows += "</td>";
                        // fund source
                        rows += "<td>";
                        rows += data[i].fund_source;
                        rows += "</td>";
                        // activity type
                        rows += "<td>";
                        rows += data[i].act_type;
                        rows += "</td>";
                        //action
                        rows += '<td><button type="button" class="btn btn-warning" disabled>Update</button>\
                            <button type="button" class="btn btn-info" id="open_items_btn" openItems('+i+')>Items</button></td>';

                        rows += "</tr>";

                        $('#acts_rows').append(rows);
                    }
                    
                    $('#acts_modal').modal('toggle');
                    $('#act_ppmp_id').val(ppmp_list[ppmp_index].ppmp_id);
                }
            });
            
        }

        function openItems(acts_index) {
            $('#items_modal').modal('toggle');
            // $.ajax({
            //     url: 'controller.php',
            //     type: 'POST',
            //     data: {
            //         func: 'getItems',
            //         // item_act_id: ppmp_list[ppmp_index].ppmp_id
            //     },
            //     success: function(res) {
            //         let data = $.parseJSON(res);
            //         $('#acts_rows').empty();
            //         // append data to table
            //         for(let i = 0; i < data.length; i++) {
            //             let rows = '';
            //             rows += "<tr>";
                        
            //             // activity name
            //             rows += "<td>";
            //             rows += data[i].act_name;
            //             rows += "</td>";
            //             // fund source
            //             rows += "<td>";
            //             rows += data[i].fund_source;
            //             rows += "</td>";
            //             // activity type
            //             rows += "<td>";
            //             rows += data[i].act_type;
            //             rows += "</td>";
            //             //action
            //             rows += '<td><button type="button" class="btn btn-warning" disabled>Update</button>\
            //                 <button type="button" class="btn btn-info" id="open_items_btn" disabled>Items</button></td>';

            //             rows += "</tr>";

            //             $('#acts_rows').append(rows);
            //         }
                    
            //         $('#items_modal').modal('toggle');
            //         $('#act_ppmp_id').val(ppmp_list[ppmp_index].ppmp_id);
            //     }
            // });
            
        }
    </script>
</body>
</html>