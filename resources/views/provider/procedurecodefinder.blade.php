@section('title','Procedure Code Finder')
@extends('layouts.frontend.main')
@section('content')
<section class="main-page-wrap">
    <div class="member-enrollment-sec">
        <div class="page-header family-profile-header">
            <div class="container">
                <div class="family-hd-wrap d-flex flex-wrap align-items-center justify-content-between">
                    <div class="family-name">
                        <h4>Procedure Code Finder</h4>
                        <p>{{Auth::guard('provider')->user()->first_name." ".Auth::guard('provider')->user()->last_name}}</p>
                    </div>
                    <div class="family-buttons d-flex align-items-center">
                        <a href="{{route('provider.dashboard')}}" class="enrol-btn hd-back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                        <a href="{{route('provider.logout')}}" class="enrol-btn"> Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- enroll-content-outer -->
        <div class="enroll-content-outer provider-view-offices-outer provider-edit-offices-outer">
            <div class="container">
                <div class="enroll-content-wrap">
                    <div class="view-claim-header">
                        <div>
                            <p>All procedure codes displayed in the Procedure code details 
                                box are supported by the FCB Dental Network and will be reimbursed
                                 at the RBP Price based on the Provincial Fee Guide.
                            </p><br>
                        </div>
                    </div>
                    <div class="edit-prv-off-row">
                        <div class="form-group">
                            <h4 class="enroll-cstm-form-heading">
                                <span>Search by classification code</span>
                            </h4>
                            <div style="padding:10px;">
                            <p><b>Select a Service</b></p>
                            <input type="radio" name="classi_code" value="1"> Diagnostic services <br>
                            <input type="radio" name="classi_code" value="2"> Preventative Services <br>
                            <input type="radio" name="classi_code" value="3"> Restoration Services<br>
                            <input type="radio" name="classi_code" value="4"> Endodontics Services<br>
                            <input type="radio" name="classi_code" value="5"> Periodontics Services<br>
                            <input type="radio" name="classi_code" value="6"> Removable Prosthodontics<br>
                            <input type="radio" name="classi_code" value="7"> Fixed Prosthodontics<br>
                            <input type="radio" name="classi_code" value="8"> Surgical Services<br>
                            <input type="radio" name="classi_code" value="9"> Orthodontics<br>
                            <input type="radio" name="classi_code" value="10"> Adjunctive Services<br>
                            <button type="submit" class="btn enrol-btn" style="padding: 8px !important;" onClick=SearchProcedureCode();>Search Procedure code</button>
                            <span id="error_service_select" class="text-danger"></span>
                            <p><img style="width: 66px;display:none;" id="procedure_loader" src="https://c.tenor.com/wfEN4Vd_GYsAAAAM/loading.gif"></p>
                        </div>
                        </div>

                        <div class="form-group" id="box2" style="display:none;">
                            <h4 class="enroll-cstm-form-heading">
                                <span>Procedure code details</span>
                            </h4>    
                            <div style="max-height: 550px;overflow-y: scroll;">
                                <table class="table" style="margin-top:20px;">
                                    <thead>
                                        <tr>
                                            <td width="20%"><b>Service Code</b></td>
                                            <td><b>Service Code Category</b></td>
                                            <td><b>Service Code SubCategory</b></td>
                                        </tr>
                                    </thead>    
                                    <tbody id="searchprocedurecode"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="family-buttons family-buttons-bottom d-flex align-items-center">
                    <a href="{{route('provider.dashboard')}}" class="enrol-btn hd-back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                    <a href="{{route('provider.logout')}}" class="enrol-btn"> Logout</a>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
function SearchProcedureCode(){
    const id = $("input[name='classi_code']:checked").val();
    if(id){
        $('#procedure_loader').show();
        $('#error_service_select').empty();
        $.ajax({
            url: `{{route('provider.searchprocedurecodebyid')}}`,
            type: 'GET',
            data: {
                "_token": "{{csrf_token()}}",
                "id": id
            },
            success: function(result) {
                $('#procedure_loader').hide();
                $("#box2").show();
                result.sort(function(a, b) {
                var keyA = new Date(a.service_code),
                    keyB = new Date(b.service_code);
                
                if (keyA < keyB) return -1;
                if (keyA > keyB) return 1;
                return 0;
                });
                $("#searchprocedurecode").empty();
                $.each(result, function (key, val) {
                    var listdata = '<tr><td>'+val.service_code+'</td><td> '+val.service_code_category+'</td><td>'+val.service_code_subcategory+'</td></tr>';
                    $("#searchprocedurecode").append(listdata);
                });
            }
        });    
    }else{
        $('#error_service_select').empty().append('Please Select a Service');
    }
    
}
</script>    
@endsection