                <?php

                include('header.php');
                include('sidebar.php');
            

                ?>
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
                                                            <table class="table" id="linkTable">
                                                                <thead class="">
                                                                <tr>
                                                                        <th>#</th>
                                                                        <th>Name</th>
                                                                        <th>Link</th>
                                                                        <th>Category</th>   
                                                                        <th>Date</th>
                                                                 

                                                                    </tr>
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
                                        <div class="modal" tabindex="-1" id="linkmodal">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Link form </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="linkform">
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

                                                                        <label for="">Name</label>
                                                                        <input type="text" class="form-control" name="name" id="name" required>
                                                                    </div>
                                                                </div>
                                                                         
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for="">Link</label>
                                                                        <select id="link_id" name="link" class="form-control"  required>
                                                                          

                                                                        </select>
                                                                    </div>

                                                                </div>
                                                      
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for="">Catergory</label>
                                                                        <select id="category_id" name="category" class="form-control"  required>
                                                                            

                                                                        </select>
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
                <script src="../js/system_link.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
