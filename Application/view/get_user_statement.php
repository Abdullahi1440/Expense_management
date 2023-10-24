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
                                                    <form id="userForm">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <select text="type" name="type"  id="type"class="form-control">
                                                                <option value="0">All</option>
                                                                <option value="custome">custome</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="date" name="from" id="from" class="form-control">
                                                            
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="date" name="to" id="to" class="form-control">

                                                        </div>

                                                    </div>
                                                    <button type="submit" class="btn btn-success float-right" id="AddNew"> Add New transtion </button>

                                                    </form>
                                                    <div class="card-block table-border-style">
                                                        <div class="table-responsive">
                                                            <table class="table" id="userTable">
                                                                <thead>
                                                                   
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
                <script src="../js/user_statement.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
