<?php
require('dmxConnectLib/dmxConnect.php');

$app = new \lib\App();

$app->exec(<<<'JSON'
{
	"steps": [
		"Connections/compensation",
		"SecurityProviders/security",
		{
			"module": "auth",
			"action": "restrict",
			"options": {"permissions":"Admin","loginUrl":"index.php","forbiddenUrl":"402.php","provider":"security"}
		}
	]
}
JSON
, TRUE);
?><!doctype html>
<html>

<head>
    <base href="/">
    <script src="dmxAppConnect/dmxAppConnect.js"></script>
    <meta charset="UTF-8">
    <title>Rewards Calculator</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="bootstrap/5/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="dmxAppConnect/dmxBootstrap5Navigation/dmxBootstrap5Navigation.js" defer></script>
    <script src="dmxAppConnect/dmxDataTraversal/dmxDataTraversal.js" defer></script>
    <link rel="stylesheet" href="dmxAppConnect/dmxBootstrap5TableGenerator/dmxBootstrap5TableGenerator.css" />
    <script src="dmxAppConnect/dmxFormatter/dmxFormatter.js" defer></script>
    <link rel="stylesheet" href="dmxAppConnect/dmxValidator/dmxValidator.css" />
    <script src="dmxAppConnect/dmxValidator/dmxValidator.js" defer></script>
    <script src="dmxAppConnect/dmxBootbox5/bootstrap-modbox.min.js" defer></script>
    <script src="dmxAppConnect/dmxBootbox5/dmxBootbox5.js" defer></script>
    <link rel="stylesheet" href="dmxAppConnect/dmxNotifications/dmxNotifications.css" />
    <script src="dmxAppConnect/dmxNotifications/dmxNotifications.js" defer></script>
    <script src="dmxAppConnect/dmxBrowser/dmxBrowser.js" defer></script>
</head>

<body id="users" is="dmx-app">
    <dmx-notifications id="notifies1"></dmx-notifications>
    <dmx-serverconnect id="scUsers" url="dmxConnect/api/Users.php"></dmx-serverconnect>
    <dmx-data-view id="dvUsers" dmx-bind:data="scUsers.data.query.data"></dmx-data-view>
    <dmx-data-detail id="ddUsers" dmx-bind:data="dvUsers.data" key="user_id"></dmx-data-detail>
    <dmx-serverconnect id="scDelUsers" url="dmxConnect/api/UserDel.php" noload></dmx-serverconnect>

    <?php include 'navbar.php'; ?>

    <div class="container my-5 pb-5">
        <div class="row">
            <div class="card px-0">
                <div class="card-header">
                    User List
                    <a href="#" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#UserModalAddEdit" dmx-on:click="ddUsers.select(0)">Add New User</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>User type</th>
                                    <th>Email</th>
                                    <th>Calculator access</th>
                                    <th>Active</th>
                                    <th>Created on</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="dvUsers.data" id="tableRepeat2">
                                <tr>
                                    <td dmx-text="$index+1"></td>
                                    <td dmx-text="firstname"></td>
                                    <td dmx-text="lastname"></td>
                                    <td dmx-text="user_type"></td>
                                    <td dmx-text="email"></td>
                                    <td dmx-text="(calculator_access==1)?'Yes':'No'" dmx-class:text-primary="(calculator_access==1)" dmx-class:text-warning="(calculator_access!=1)"></td>
                                    <td dmx-text="(active==1)?'Active':'Inactive'" dmx-class:text-success="(active==1)" dmx-class:text-danger="(active!=1)"></td>
                                    <td dmx-text="created_on.formatDate('MMM dd yyyy hh:mm:ss')"></td>
                                    <td>
                                        <button class="btn btn-sm" dmx-on:click="ddUsers.select(user_id)"><i class="far fa-edit" data-bs-toggle="modal" data-bs-target="#UserModalAddEdit"></i></button>
                                        <button class="btn btn-sm" dmx-on:click="run({'bootbox.confirm':{message:'Are you sure to delete this user?',title:'Delete User',buttons:{confirm:{label:'Yes',className:'btn-danger'},cancel:{label:'No',className:'btn-secondary'}},centerVertical:true,then:{steps:{run:{action:`scDelUsers.load({user_id: user_id});notifies1.success(\'Success! User Deleted\');scUsers.load({},true)`}}},name:'DelUser'}})" dmx-show="(user_type!='Admin')"><i class="far fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="UserModalAddEdit" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="post" id="FormUsersAddEdit" is="dmx-serverconnect-form" action="dmxConnect/api/UserAddEdit.php" dmx-on:success="notifies1.success(FormUsersAddEdit.data.Message);scUsers.load({},true);FormUsersAddEdit.reset(true)" dmx-on:invalid="notifies1.warning(lastError.response)" dmx-on:forbidden="notifies1.warning(lastError.response)" dmx-on:unauthorized="notifies1.warning(lastError.response)" dmx-on:error="notifies1.warning(lastError.response)">
                <input type="hidden" name="user_id" dmx-bind:value="ddUsers.data.user_id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">{{ddUsers.data.user_id?'Edit User':'Add New User'}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" dmx-on:click="ddUsers.select(0)"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mx-0">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="inp_fname" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="inp_fname" name="firstname" placeholder="Enter first name" required="" dmx-bind:value="ddUsers.data.firstname">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="inp_lname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="inp_lname" name="lastname" placeholder="Enter last name" required="" dmx-bind:value="ddUsers.data.lastname">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="inp_email" class="form-label">Email Id</label>
                                    <input type="text" class="form-control" id="inp_email" name="email" placeholder="Enter a valid Email-id" data-rule-email="" required="" dmx-bind:value="ddUsers.data.email">
                                </div>
                            </div><div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="inp_user_type" class="form-label">User Type</label>
                                    <select type="text" class="form-select" id="inp_user_type" name="user_type" required="" dmx-bind:value="ddUsers.data.user_type">
                                        <option value="">Select</option>
                                        <option value="Admin">Admin</option>
                                        <option value="User">User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="inp_status" class="form-label">Status</label>
                                    <select type="text" class="form-select" id="inp_status" name="active" required="" dmx-bind:value="ddUsers.data.active">
                                        <option value="">Select</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="inp_access" class="form-label">Calculator Access</label>
                                    <select type="text" class="form-select" id="inp_access" name="calculator_access" required="" dmx-bind:value="ddUsers.data.calculator_access">
                                        <option value="">Select</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="inp_pass" class="form-label">Password</label>
                                    <input type="text" class="form-control" id="inp_pass" name="password" required="" dmx-bind:value="ddUsers.data.blank1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" dmx-on:click="ddUsers.select(0)">Close</button>
                        <button type="submit" class="btn btn-primary">{{ddUsers.data.user_id?'Update':'Save'}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Footer -->
    <?php include 'footer.php'; ?>
    <!-- Footer -->
    <script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>

</html>