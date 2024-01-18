<?php

include('header.php');
include('sidebar.php');


?>
<style>
    #show{
        width: 150px;
        height: 150px;
        border:solid 2px #744547;
        border-radius: 50%;
        object-fit: cover;

    }
</style>
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <!-- [ breadcrumb ] start -->

                <!-- [ breadcrumb ] end -->
                <div class="main-body">
                    <div class="page-wrapper">
                        <!-- [ Main Content ] start -->
                        <!-- [ start row ]  -->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Basic Table</h5>

                                    </div>
                                    <div class="card-block table-border-style">
                                        <div class="table-responsive">
                                            <button class="btn btn-success float-right" id="AddNew"> Add New transtion </button>
                                            <table class="table" id="userList_table">
                                                <thead>
                                                <th></th>
                                                </thead>
                                                <tbody>
                                               
                                                </tbody>

                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [row] end -->
                        <div class="modal" tabindex="-1" id="usermodal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">User Form </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="userform" enctype="multipart/form-data">
                                            <div class="row">

                                                <div class="col-12">
                                                <div class="alert alert-success d-none" role="alert">
                                                   Record  is a success fully !
                                                </div>
                                                <div class="alert alert-danger d-none" role="alert">
                                                there is error please make sure!
                                                </div>
                                                </div>
                                                <div class="col-sm-12">
                                                        <input type="hidden" name="update_id" id="update_id">
                                                    <div class="form-group">

                                                        <label for="">username</label>
                                                        <input type="text" class="form-control" name="username" id="username" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="">Password</label>
                                                        <input type="password" id="password" name="password" class="form-control">
                                                    </div>
                                                
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="">image</label>
                                                        <input type="file" id="image" name="image"  class="form-control" required>
                                                    </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="col-8">
                                                    <div class="form-group justify-content-center">
                                                       <img id="show" >

                                                    </div>
                                                </div>

                                                </div>
                                            </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>


                        <!-- [ Main Content ] end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

include('footer.php');


?>
    <script src="../js/user.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
